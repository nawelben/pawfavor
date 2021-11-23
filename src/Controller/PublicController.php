<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Testimonial;
use App\Entity\User;
use App\Entity\SitterServicePrice;
use App\Entity\SitterSkill;
use App\Entity\SitterLanguage;
use App\Entity\SitterPetCategory;
use App\Entity\SitterHome;
use App\Entity\Review;
use App\Entity\Pet;

use App\Entity\Booking;
use App\Entity\BookingDetail;
use App\Entity\Message;
use App\Entity\Service;

use \Datetime;

class PublicController extends AbstractController
{
    /**
     * @Route("/", name="public_home")
     */
    public function home(): Response
    {
      $em = $this->getDoctrine()->getManager();
      $testimonials = $em->getRepository(Testimonial::class)->findAll();


        return $this->render('public/home.html.twig', [
            'testimonials' => $testimonials,
        ]);
    }

    /**
     * @Route("/search", name="public_search")
     */
    public function search(): Response
    {
        return $this->render('public/search.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }

    /**
     * @Route("/view_sitter/{id}", name="public_sitter")
     */
    public function sitter(Request $request, $id): Response
    {
        $em = $this->getDoctrine()->getManager();

        $sitter = $em->getRepository(User::class)->find(1);

        $_service = $request->request->has('_service')?$request->request->get('_service'):null;
        $_pets = $request->request->has('_pets')?$request->request->get('_pets'):array();
        $_start = $request->request->has('_start')?$request->request->get('_start'):null;
        $_end = $request->request->has('_end')?$request->request->get('_end'):null;
        $_message = $request->request->has('_message')?$request->request->get('_message'):null;
        $_total_price = $request->request->has('_total_price')?$request->request->get('_total_price'):null;


        if($_service  && $_start && $_end && $_message && $_total_price){

          $service = $em->getRepository(Service::class)->find($_service);
          $pets = array();
          foreach($_pets as $_pet){
            $pet = $em->getRepository(Pet::class)->find($_pet);
            $pets[] = $pet;
          }
          $start = $_start;
          $end = $_end;
          $message = $_message;
          $total_price = $_total_price;
          $owner = $this->getUser();

          $booking = new Booking();
          $booking->setSitter($sitter);
          $booking->setService($service);
          $booking->setStart(new DateTime($start));
          $booking->setEnd(new DateTime($end));
          $booking->setTotalPrice($total_price);
          $booking->setOwner($owner);
          $booking->setState("awaiting");

          $em->persist($booking);
          $em->flush();

          // save pets
          foreach($pets as $pet){
            $bookingDetail = new BookingDetail();
            $bookingDetail->setBooking($booking);
            $bookingDetail->setPet($pet);

            $em->persist($bookingDetail);
            $em->flush();
          }

          // save message
          $date = new DateTime("NOW");
          $content = $message;
          $message = new Message();
          $message->setOwner($owner);
          $message->setSitter($sitter);
          $message->setSender($owner);
          $message->setReciever($sitter);
          $message->setDate($date);
          $message->setContent($content);

          $em->persist($message);
          $em->flush();

          return $this->redirectToRoute('owner_inbox');
        }




        $sitterServicePrices = $em->getRepository(SitterServicePrice::class)->findBySitter($sitter);
        $sitterSkills = $em->getRepository(SitterSkill::class)->findBySitter($sitter);
        $sitterLanguages = $em->getRepository(SitterLanguage::class)->findBySitter($sitter);
        $sitterPetCategories = $em->getRepository(SitterPetCategory::class)->findOneBySitter($sitter);
        $sitterHome = $em->getRepository(SitterHome::class)->findOneBySitter($sitter);
        $reviews = $em->getRepository(Review::class)->findBySitter($sitter);

        $pets = $em->getRepository(Pet::class)->findByUser($this->getUser());

        return $this->render('public/sitter.html.twig', [
            'sitter' => $sitter,
            'sitterServicePrices' => $sitterServicePrices,
            'sitterSkills' => $sitterSkills,
            'sitterLanguages' => $sitterLanguages,
            'sitterPetCategories' => $sitterPetCategories,
            'sitterHome' => $sitterHome,
            'reviews' => $reviews,
            'pets' => $pets
        ]);

    }

    /**
     * @Route("/view_owner/{id}", name="public_owner")
     */
    public function owner($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $owner = $em->getRepository(User::class)->find($id);

        return $this->render('public/owner.html.twig', [
            'owner' => $owner,
        ]);
    }

}
