<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Notification;
use App\Entity\Booking;
use App\Entity\Message;

class SitterController extends AbstractController
{
    /**
     * @Route("/sitter/dashboard", name="sitter_dashboard")
     */
    public function dashboard(): Response
    {
      $em = $this->getDoctrine()->getManager();

      $notifications = $em->getRepository(Notification::class)->findBySitter($this->getUser());
      $upcomingBookings = $em->getRepository(Booking::class)->findBy(
        array('sitter' => $this->getUser(),
              'state' => 'accepted')
      );
      $awaitingBookings = $em->getRepository(Booking::class)->findBy(
        array('sitter' => $this->getUser(),
              'state' => 'awaiting')
      );

        return $this->render('sitter/dashboard.html.twig', [
            'notifications' => $notifications,
            'upcomingBookings' => $upcomingBookings,
            'awaitingBookings' => $awaitingBookings,
        ]);
    }


    /**
     * @Route("/sitter/bookings", name="sitter_bookings")
     */
    public function bookings(Request $request): Response
    {
      $em = $this->getDoctrine()->getManager();

      if($request->request->has('__accept_booking')){
        $booking = $em->getRepository(Booking::class)->find($request->request->get('__booking_id'));
        $booking->setState('accepted');
        $em->persist($booking);
        $em->flush();
      }

      if($request->request->has('__decline_booking')){
        $booking = $em->getRepository(Booking::class)->find($request->request->get('__booking_id'));
        $booking->setState('cancelled');
        $em->persist($booking);
        $em->flush();
      }

      if($request->request->has('__complete_booking')){
        $booking = $em->getRepository(Booking::class)->find($request->request->get('__booking_id'));
        $booking->setState('completed');
        $em->persist($booking);
        $em->flush();
      }

      if($request->request->has('__cancel_booking')){
        $booking = $em->getRepository(Booking::class)->find($request->request->get('__booking_id'));
        $booking->setState('cancelled');
        $em->persist($booking);
        $em->flush();
      }

      $upcomingBookings = $em->getRepository(Booking::class)->findBy(
        array('sitter' => $this->getUser(),
              'state' => 'accepted'),
        array('id' => "DESC")
      );
      $awaitingBookings = $em->getRepository(Booking::class)->findBy(
        array('sitter' => $this->getUser(),
              'state' => 'awaiting'),
        array('id' => "DESC")
      );
      $completedBookings = $em->getRepository(Booking::class)->findBy(
        array('sitter' => $this->getUser(),
              'state' => 'completed'),
        array('id' => "DESC")
      );
      $cancelledBookings = $em->getRepository(Booking::class)->findBy(
        array('sitter' => $this->getUser(),
              'state' => 'cancelled'),
        array('id' => "DESC")
      );

        return $this->render('sitter/bookings.html.twig', [
            'upcomingBookings' => $upcomingBookings,
            'awaitingBookings' => $awaitingBookings,
            'completedBookings' => $completedBookings,
            'cancelledBookings' => $cancelledBookings,
        ]);
    }

    /**
     * @Route("/sitter/inbox", name="sitter_inbox")
     */
    public function inbox(Request $request): Response
    {




      $em = $this->getDoctrine()->getManager();
      $req = $em->getRepository(Message::class)->createQueryBuilder('q')
                 ->where('q.sitter = :sitter')
                 ->groupBy('q.owner')
                 ->orderBy('q.id', 'DESC')

                 ->setParameters(array('sitter' => $this->getUser()))
                 ->getQuery();
      $_conversations = $req->getResult();
      $conversations = array();

      $actualConversation = null;
      // TODO check if there is parameter actualConversation
      if($request->request->has('owner_id')){
        $_tempOwner =  $em->getRepository(Message::class)->find($request->request->get('owner_id'));
        $actualConversation = $em->getRepository(Message::class)->findOneByOwner($_tempOwner);
      }

      if($request->request->has('__accept_booking')){
        $booking = $em->getRepository(Booking::class)->find($request->request->get('__booking_id'));
        $booking->setState('accepted');
        $em->persist($booking);
        $em->flush();

        $_tempOwner =  $booking->getOwner();
        $actualConversation = $em->getRepository(Message::class)->findOneByOwner($_tempOwner);
      }

      if($request->request->has('__decline_booking')){
        $booking = $em->getRepository(Booking::class)->find($request->request->get('__booking_id'));
        $booking->setState('cancelled');
        $em->persist($booking);
        $em->flush();

        $_tempOwner =  $booking->getOwner();
        $actualConversation = $em->getRepository(Message::class)->findOneByOwner($_tempOwner);
      }

      foreach($_conversations as $_conversation){

        $conversation = $em->getRepository(Message::class)->findOneBy(array("owner"=>$_conversation->getOwner()), array("id"=>"DESC"));
        $conversations[] = $conversation;
        if($actualConversation == null){
          $actualConversation = $conversation;
        }
      }

      $messages = null;
      $booking = null;

      if($actualConversation){
        $messageContent = $request->request->has('_content')?$request->request->get('_content'):null;


        if($messageContent){
          $message = new Message();
          $message->setSender($this->getUser());
          $message->setReciever($actualConversation->getOwner());
          $message->setContent($messageContent);
          $message->setDate(new \DateTime("NOW"));
          $message->setOwner($actualConversation->getOwner());
          $message->setSitter($this->getUser());

          $em->persist($message);
          $em->flush();
        }

        $messages = $em->getRepository(Message::class)->findBy(
          array('sitter' => $this->getUser(),
                'owner' => $actualConversation->getOwner()),
          array("id"=>"ASC")
        );

        $booking = $em->getRepository(Booking::class)->findOneBy(
          array('sitter' => $this->getUser(),
                'owner' => $actualConversation->getOwner()),
          array("id"=>"DESC")
        );
      }


      $messages;

        return $this->render('sitter/inbox.html.twig', [
            'conversations' => $conversations,
            'messages' => $messages,
            'booking' => $booking,
            'actualConversation' => $actualConversation
        ]);
    }

    /**
     * @Route("/sitter/calendar", name="sitter_calendar")
     */
    public function calendar(): Response
    {
        return $this->render('sitter/calendar.html.twig', [
            'controller_name' => 'SitterController',
        ]);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //                                            PROFILE
    //
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




    /**
     * @Route("/sitter/profile", name="sitter_profile")
     */
    public function sitterProfile(): Response
    {
      return $this->redirectToRoute('public_sitter', array("id" => $this->getUser()->getId()));
    }

    /**
     * @Route("/sitter/account_informations", name="sitter_account_informations")
     */
    public function sitterAccountInformations(): Response
    {
      return $this->render('sitter/account_informations.html.twig', [
          'sitter' => $this->getUser()
      ]);
    }

    /**
     * @Route("/sitter/preferences", name="sitter_preferences")
     */
    public function sitterPreferences(): Response
    {
      return $this->render('sitter/preferences.html.twig', [
          'sitter' => $this->getUser()
      ]);
    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //                                            POST REQUESTS
    //
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    /**
     * @Route("/sitter/update_disponibility", name="sitter_update_disponibility")
     */
    public function updateDisponibility(Request $request): Response
    {
      // check if has all fields : Day + s1...s5 + n1...n5 + token
      // if all is ok : for each 5 services :  new disponibilities & save

      $submittedToken = $request->request->get('calendar_token');
      if ($this->isCsrfTokenValid('calendar_token', $submittedToken)) {

      }

      return $this->render('sitter/calendar.html.twig', [

      ]);
    }


}
