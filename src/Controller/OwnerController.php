<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Pet;
use App\Form\PetType;

use App\Entity\Notification;
use App\Entity\Booking;
use App\Entity\Message;

class OwnerController extends AbstractController
{
    /**
     * @Route("/owner/profile", name="owner_profile")
     */
    public function ownerProfile(): Response
    {
      return $this->redirectToRoute('public_owner', array("id" => $this->getUser()->getId()));
    }

    /**
     * @Route("/owner/account_informations", name="owner_account_informations")
     */
    public function ownerAccountInformations(): Response
    {
      return $this->render('owner/account_informations.html.twig', [
          'owner' => $this->getUser()
      ]);
    }

    /**
     * @Route("/owner/preferences", name="owner_preferences")
     */
    public function ownerPreferences(): Response
    {
      return $this->render('owner/preferences.html.twig', [
          'owner' => $this->getUser()
      ]);
    }

    /**
     * @Route("/owner/bookings", name="owner_bookings")
     */
    public function ownerBookings(): Response
    {
      $em = $this->getDoctrine()->getManager();
      $upcomingBookings = $em->getRepository(Booking::class)->findBy(
        array('owner' => $this->getUser(),
              'state' => 'accepted')
      );
      $awaitingBookings = $em->getRepository(Booking::class)->findBy(
        array('owner' => $this->getUser(),
              'state' => 'awaiting')
      );
      $completedBookings = $em->getRepository(Booking::class)->findBy(
        array('owner' => $this->getUser(),
              'state' => 'completed')
      );
      $cancelledBookings = $em->getRepository(Booking::class)->findBy(
        array('owner' => $this->getUser(),
              'state' => 'cancelled')
      );

        return $this->render('owner/bookings.html.twig', [
            'upcomingBookings' => $upcomingBookings,
            'awaitingBookings' => $awaitingBookings,
            'completedBookings' => $completedBookings,
            'cancelledBookings' => $cancelledBookings,
        ]);

    }

    /**
     * @Route("/owner/saved_sitters", name="owner_saved_sitters")
     */
    public function ownerSavedSitters(): Response
    {
      return $this->render('owner/saved_sitters.html.twig', [
          'owner' => $this->getUser()
      ]);
    }


    /**
     * @Route("/owner/inbox", name="owner_inbox")
     */
    public function ownerInbox(Request $request): Response
    {



      $em = $this->getDoctrine()->getManager();
      $req = $em->getRepository(Message::class)->createQueryBuilder('q')
                 ->where('q.owner = :owner')
                 ->groupBy('q.sitter')
                 ->orderBy('q.id', 'DESC')
                 ->setParameters(array('owner' => $this->getUser()))
                 ->getQuery();
      $_conversations = $req->getResult();
      $conversations = array();

      $actualConversation = null;
      // TODO check if there is parameter actualConversation
      if($request->request->has('sitter_id')){
        $_tempSitter =  $em->getRepository(Message::class)->find($request->request->get('sitter_id'));
        $actualConversation = $em->getRepository(Message::class)->findOneBySitter($_tempSitter);
      }



      foreach($_conversations as $_conversation){
        $conversation = $em->getRepository(Message::class)->findOneBy(array("sitter"=>$_conversation->getSitter()), array("id"=>"DESC"));
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
          $message->setReciever($actualConversation->getSitter());
          $message->setContent($messageContent);
          $message->setDate(new \DateTime("NOW"));
          $message->setOwner($this->getUser());
          $message->setSitter($actualConversation->getSitter());

          $em->persist($message);
          $em->flush();

          
        }




        $messages = $em->getRepository(Message::class)->findBy(
          array('owner' => $this->getUser(),
                'sitter' => $actualConversation->getSitter()),
          array("id"=>"ASC")
        );

        $booking = $em->getRepository(Booking::class)->findOneBy(
          array('owner' => $this->getUser(),
                'sitter' => $actualConversation->getSitter()),
          array("id"=>"DESC")
        );
      }

        return $this->render('owner/inbox.html.twig', [
            'conversations' => $conversations,
            'messages' => $messages,
            'booking' => $booking,
            'actualConversation' => $actualConversation
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
     * @Route("/owner/make_booking", name="owner_make_booking")
     */
    public function makeBooking(Request $request): Response
    {
        $booking = _makeBookingFromRequest($request);

        // save booking

        // save payment

        // save message

        return $this->render('owner/payment.html.twig', [
            'owner' => $this->getUser(),
            'booking' => $booking
        ]);
    }




    /**
     * @Route("/owner/become_sitter", name="owner_become_sitter")
     */
    public function becomeSitter(Request $request): Response
    {

      $submittedToken = $request->request->get('token');

      if ($this->isCsrfTokenValid('become-sitter', $submittedToken)) {
        $user = $this->getUser();
        $roles = $user->getRoles();
        $roles[] = "ROLE_SITTER";
        $user->setRoles($roles);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('sitter', array("success" => "welcome_new_sitter"));

      }else{
        return $this->redirectToRoute('owner', array("error" => "error"));
      }

    }

    /**
     * @Route("/owner/add_pet", name="owner_add_pet")
     */
    public function addPet(Request $request): Response
    {
        $pet = new Pet();

        $form = $this->createForm(PetType::class, $pet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($pet);
            $em->flush();

            return $this->redirectToRoute('owner');
        }

        return $this->render('owner/add_pet.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
