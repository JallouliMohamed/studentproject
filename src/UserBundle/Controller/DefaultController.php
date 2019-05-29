<?php

namespace UserBundle\Controller;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use UserBundle\Entity\Affectation;
use UserBundle\Entity\Entreprise;
use UserBundle\Entity\Internship;
use UserBundle\Entity\Messenger;
use UserBundle\Entity\Notification;
use UserBundle\Form\AffectationType;
use UserBundle\Form\EntrepriseType;
use UserBundle\Form\InternshipType;
use UserBundle\Form\MessengerType;


class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $notif =null;
        $student=null;
        //die($usr);
        $usr=$this->container->get('security.authorization_checker');
        if (($usr->isGranted('ROLE_ADMIN'))){
            return $this->render('UserBundle:Default:backoffice.html.twig');
        }if($usr->isGranted('IS_AUTHENTICATED_REMEMBERED')){$user = $this->getUser()->getId();

        if($this->getUser()->getRole()=="etudiant"){
            $notif=$em->getRepository('UserBundle:Notification')->findBy(array("entityname"=>"Notification","userid"=>$user));
            $notif2=$em->getRepository('UserBundle:Notification')->findBy(array("entityname"=>"Message","userid"=>$user));

            return $this->render('UserBundle:Default:index.html.twig',array("notif"=>$notif,"count3"=>sizeof($notif),"count4"=>sizeof($notif2)));
            dump($notif);
        }


        $student=$em->getRepository('UserBundle:Notification')->findBy(array("entityname"=>"Student","userid"=>$user));
        $notif=$em->getRepository('UserBundle:Notification')->findBy(array("entityname"=>"Affectation","userid"=>$user));
        $notif2=$em->getRepository('UserBundle:Notification')->findBy(array("entityname"=>"Message","userid"=>$user));

        dump($notif);
        if(sizeof($notif2)==0){
            //$id=$em->getRepository('UserBundle:User')->find($user);
            return $this->render('UserBundle:Default:index.html.twig',array('count'=>sizeof($notif),'count2'=>sizeof($student),'student'=>$student,'notif'=>$notif,'count4'=>0));
        }
        else{
            return $this->render('UserBundle:Default:index.html.twig',array('count'=>sizeof($notif),'count2'=>sizeof($student),'student'=>$student,'notif'=>$notif,"count4"=>sizeof($notif2)));
        }    }

        return $this->render('UserBundle:Default:index.html.twig');






    }
    public function profileAction()
    {
        $usr= $this->get('security.token_storage')->getToken()->getUser();
        return $this->render('@User/Default/profile.html.twig',array('user'=>$usr));
    }
    public function profilethroughtproffesorAction(Request $request)
    {
        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $usr=$em->getRepository('UserBundle:User')->find($id);
        return $this->render('@User/Default/profile.html.twig',array('user'=>$usr));

    }
    public function studentListAction(){
        $usr= $this->get('security.token_storage')->getToken()->getUser();
        $em=$this->getDoctrine()->getManager();
        $user = $this->getUser()->getId();
        $notif=$em->getRepository('UserBundle:Notification')->findBy(array("userid"=>$user,"entityname"=>"Student"));
        foreach ($notif as $e){
            $em->remove($e);
            $em->flush();
        }
        $user=$em->getRepository('UserBundle:User')->findBy(array('proffesorid'=>$usr->getId()));
        return $this->render('@User/Default/studentlist.html.twig',array('users'=>$user));
    }

    public function addEntrepriseAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $entreprise = new Entreprise();
        $form = $this->createForm(EntrepriseType::class, $entreprise);
        $form->handleRequest($request);
        $session = new Session();
        if($form->isValid())
        {
            /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $file */

            $file = $entreprise->getImage();

            $fileName = $this->generateUniqueFileName().'.'.'jpg';

            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('brochures_directory'),
                $fileName
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $entreprise->setImage($fileName);

            $em->persist($entreprise);
            $em->flush();
            $session->getFlashBag()->add('success', 'entreprise added ');
            return $this->redirectToRoute('user_homepage');
        }
       return $this->render('@User/Default/addentreprise.html.twig',array('form' => $form->createView()));
    }
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
    public function listentrepriseAction(){
        $em=$this->getDoctrine()->getManager();
        $entreprises=$em->getRepository('UserBundle:Entreprise')->findAll();
        return $this->render('UserBundle:Default:Listentreprise.html.twig',array('entreprises'=>$entreprises));
    }
    public function addaffectationAction(Request $request){

        $em=$this->getDoctrine()->getManager();
        $affectation=new Affectation();
        $u=$request->get('f');
        $e=$request->get('e');
        $test=$em->getRepository('UserBundle:Affectation')->findBy(array('entrepriseid'=>$e,'who'=>$u));
        $session = new Session();
        if($test==null){
        $user=$em->getRepository('UserBundle:User')->find($u);
        $entreprise=$em->getRepository('UserBundle:Entreprise')->find($e);
        $t=$user->getProffesorid();
        $teacher=$em->getRepository('UserBundle:User')->find($t);
        $affectation->setTeacher($teacher);
        $affectation->setEntrepriseid($entreprise);
        $affectation->setWho($user);
        $affectation->setStatus(1);
        $notif=new Notification();
        $notif->setEntityname("Affectation");
        $notif->setUserid($teacher);
        $notif->setTexto("You have received an apply ".$user->getUsername());
            $arrData = ['message'=>true];
            $form = $this->createForm(AffectationType::class,$affectation);
            $form->handleRequest($request);
            if ($form->isValid()){
                $em->persist($notif);
                $affectation->setStatus(1);
                $em->persist($affectation);

                $em->flush();
                $session->getFlashBag()->add('success', 'Affectation sent');
                return $this->render('@User/Default/Addaffectation.html.twig',array('form'=>$form->createView(),'f'=>$u,'e'=>$e));
            }
            return $this->render('@User/Default/Addaffectation.html.twig',array('form'=>$form->createView()));



        }
        else{
            $session->getFlashBag()->add('echec', 'you have already made a affectation');
        }

    }
    public function listaffectationAction(){

        $em=$this->getDoctrine()->getManager();
        $user = $this->getUser()->getId();
        $notif=$em->getRepository('UserBundle:Notification')->findBy(array("userid"=>$user,"entityname"=>"Affectation"));
        foreach ($notif as $e){
            $em->remove($e);
            $em->flush();
        }
        $usr= $this->get('security.token_storage')->getToken()->getUser()->getId();
        $notif=$em->getRepository('UserBundle:Notification')->findBy(array("userid"=>$usr));
        $count=sizeof($notif);
        $monitor=$em->getRepository('UserBundle:User')->findby(array("role"=>"monitor"));

        $test=$em->getRepository('UserBundle:Affectation')->findBy(array("teacher"=>$usr,"status"=>1));
        return $this->render('@User/Default/listaffectation.html.twig',array("test"=>$test,"monitor"=>$monitor));
    }
    public function addinformationstudentAction(Request $req){
        $result =$req->get('sel1');
        $rr=$req->get('idaffectation');
        $em=$this->getDoctrine()->getManager();
        $affectation=$em->getRepository("UserBundle:Affectation")->find($rr);
        $monitor=$em->getRepository("UserBundle:User")->find($result);
        $student=$em->getRepository("UserBundle:User")->find($affectation->getWho());
        dump($monitor);
        $affectation->setStatus(2);
        dump("hello");
        $affectation->setMonitor($monitor);
        dump($affectation);
        $notification=new Notification();
        $notification->setEntityname("Affectation");
        $notification->setTexto("you have been choosed for internship");
        $notification->setUserid($monitor);
        $notification1=new Notification();
        $notification1->setEntityname("Notification");
        $notification1->setTexto("the teacher accepted your internship");
        $notification1->setUserid($student);
        dump($notification);
        dump($affectation);
        $em->persist($notification1);
        $em->persist($affectation);
        $em->persist($notification);
        $em->flush();


        return $this->redirectToRoute('homepage');
        
    }
    public function rejectAffectationteacherAction(Request $request){
        $id=$request->get('id');
        $session=new Session();
        $notification=new Notification();
        $em=$this->getDoctrine()->getManager();
        $affectation=$em->getRepository('UserBundle:Affectation')->find($id);
        dump($affectation);
        $student=$em->getRepository('UserBundle:User')->find($affectation->getWho());
        $notification->setUserid($student);
        $notification->setTexto('you have been refused by the teacher');
        $notification->setEntityname('Notification');
        $em->persist($notification);
        $em->remove($affectation);
        $em->flush();
        $session->getFlashBag()->add('success', 'Affectation removed');

        return $this->redirectToRoute('listaffectaion');
    }
    public function listaffectationmonitorAction(Request $request){
        $user = $this->getUser()->getId();
        $em=$this->getDoctrine()->getManager();
        $notif=$em->getRepository('UserBundle:Notification')->findBy(array("userid"=>$user,"entityname"=>"Affectation"));
        foreach ($notif as $e){
            $em->remove($e);
            $em->flush();
        }
        $affectation=$em->getRepository('UserBundle:Affectation')->findby(array("monitor"=>$user));
        return $this->render('@User/Default/listaffectationmonitor.html.twig',array("test"=>$affectation));
    }
    public function rejectAffectationmonitorAction(Request $request){
        $user = $this->getUser()->getId();
        $em=$this->getDoctrine()->getManager();
        $id =$request->get('id');
        $affectation=$em->getRepository('UserBundle:Affectation')->find($id);
        $affectation->setMonitor(null);
        $affectation->setStatus(1);
        $teacher=$em->getRepository('UserBundle:User')->find($affectation->getTeacher());
        $notif=new Notification();
        $notif->setEntityname("Affectation");
        $notif->setTexto("the internship were rejected by monitor");
        $notif->setUserid($teacher);
        $em->persist($notif);
        $em->persist($affectation);
        $em->flush();
        return $this->redirectToRoute('listaffectationmonitor');
    }
    public function acceptinternshipAction(Request $request){
        $user=$this->getUser()->getId();
        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $affectation=$em->getRepository('UserBundle:Affectation')->find($id);
        $affectation->setStatus(3);
        $id=$affectation->getEntrepriseid()->getOwner();
        dump($affectation);
        dump($id);
        $notification=new Notification();
        $notification->setEntityname("Affectation");
        $notification->setTexto("you have a request for a internship");
        $notification->setUserid($id);
        $em->persist($affectation);
        $em->persist($notification);
        $em->flush();
      return  $this->redirectToRoute('homepage');
    }
    public function listAffectationproviderAction(Request $request){
        $user = $this->getUser()->getId();
        $em=$this->getDoctrine()->getManager();
        $notif=$em->getRepository('UserBundle:Notification')->findBy(array("userid"=>$user,"entityname"=>"Affectation"));
        if($notif!=null){
        foreach ($notif as $e){
            $em->remove($e);

        }}
        $em->flush();
        $entreprise=$em->getRepository('UserBundle:Entreprise')->findOneBy(array("owner"=>$user));
        $affectation=$em->getRepository('UserBundle:Affectation')->findBy(array("entrepriseid"=>$entreprise,"status"=>3));
        $supervisor=$em->getRepository('UserBundle:User')->findBy(array('role'=>'supervisor'));
        dump($affectation);
        dump($supervisor);

        return $this->render("@User/Default/listaffectationprovider.html.twig",array('test'=>$affectation,"supervisor"=>$supervisor));
    }
    public function addproviderAction(Request $request){
        $id=$request->get('id');

        $em=$this->getDoctrine()->getManager();

        $internship= new Internship();

        $session=new Session();
        $form = $this->createForm(InternshipType::class,$internship);
        $form->handleRequest($request);
        if ($form->isValid()){
            $affectation=$em->getRepository('UserBundle:Affectation')->find($id);
            $internship->setAffectation($affectation);
            $internship->setMonitor($em->getRepository('UserBundle:User')->find($affectation->getMonitor()->getId()));
            $internship->setStudent($em->getRepository('UserBundle:User')->find($affectation->getWho()->getId()));
            $user=$this->getUser();
            $internship->setProvider($user);
            $message=new Messenger();
            $message->setSubject("Succes");
            $message->setBody("your student has been accepted for an internship in out entreprise");
            $message->setSender($user);
            $message->setTowho($affectation->getTeacher());
            $message->setFile("azea.jpg");
            $notification1=new Notification();
            $notification1->setEntityname("Message");
            $notification1->setTexto("the teacher accepted your internship");
            $notification1->setUserid($affectation->getTeacher());
            $em->persist($message);
            $em->persist($notification1);
            $em->persist($internship);

            $em->flush();

            $session->getFlashBag()->add('success', 'Internship started');
            return ($this->redirectToRoute('addingformationprovider'));
        }
        return $this->render('@User/Default/Addinternship.html.twig',array('form'=>$form->createView()));



    }
    public function rejectformationProviderAction(Request $request){
    $id=$request->get('id');
    $em=$this->getDoctrine()->getManager();
    $affectation=$em->getRepository('UserBundle:Affectation')->find($id);
    $student =$em->getRepository('UserBundle:User')->find($affectation->getWho());
    $notification=new Notification();
    $notification->setUserid($student);
    $notification->setTexto('you have been refused by the provider');
    $notification->setEntityname('Notification');
    $em->persist($notification);
    $em->remove($affectation);
    $em->flush();
    return $this->redirectToRoute('listaffectationprovider');
    }
    public function AlllistMessageAction(){
        $user = $this->getUser()->getId();
        $em=$this->getDoctrine()->getManager();
        $notif=$em->getRepository('UserBundle:Notification')->findBy(array("userid"=>$user,"entityname"=>"Message"));
        if($notif!=null){
            foreach ($notif as $e){
                $em->remove($e);

            }}
            $em->flush();
            $messages=$em->getRepository('UserBundle:Messenger')->findBy(array("towho"=>$user));
        return $this->render("UserBundle:Default:Listmessages.html.twig",array("messages"=>$messages));
    }
    public function sendmessageAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $message=new Messenger();
        $form = $this->createForm(MessengerType::class, $message);
        $form->handleRequest($request);
        $session = new Session();
        $user = $this->getUser();

        if($form->isValid())
        {

            $message->setSender($user);

            /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $file */

            $file = $message->getFile();

            $fileName = $this->generateUniqueFileName().'.'.'pdf';

            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('brochures_directory'),
                $fileName
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $message->setFile($fileName);

            $em->persist($message);

            $notification=new Notification();
            $notification->setUserid($message->getTowho());
            $notification->setTexto('Send message');
            $notification->setEntityname('Message');
            $em->persist($notification);
            $em->flush();
            $session->getFlashBag()->add('success', 'Message sended with success');
            return $this->redirectToRoute("sendmessage");
    }
        return $this->render('@User/Default/sendMessage.html.twig',array('form'=>$form->createView()));

    }
    public function DownloadFileAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $id=$request->get('id');
        $message=$em->getRepository('UserBundle:Messenger')->find($id);

        $filename="C:\\wamp64\\www\\re\\web\\uploads\\brochures\\".$message->getFile();
        $response = new Response();

// Set headers
        $response->headers->set('Cache-Control', 'private');
        $response->headers->set('Content-type', mime_content_type($filename));
        $response->headers->set('Content-Disposition', 'attachment; filename="' . basename($filename) . '";');
        $response->headers->set('Content-length', filesize($filename));

// Send headers before outputting anything
//        $response->sendHeaders();

        $response->setContent(file_get_contents($filename));
        return $response;
    }

}
