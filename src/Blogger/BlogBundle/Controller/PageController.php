<?php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Entity\Enquiry;
use Blogger\BlogBundle\Entity\Tag;
use Blogger\BlogBundle\Entity\Blog;
use Blogger\BlogBundle\Form\EnquiryType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;

class PageController extends Controller
{
    public function indexAction(){
        $em = $this->getDoctrine()->getManager();
        $blogs = $em->getRepository('BloggerBlogBundle:Blog')->getLatestBlogs();
        return $this->render('BloggerBlogBundle:Page:index.html.twig', array('blogs' => $blogs));
    }

    public function aboutAction(){
        return $this->render('BloggerBlogBundle:Page:about.html.twig');
    }

	public function contactAction(Request $request){
	    $enquiry = new Enquiry();
	    $form = $this->createForm(EnquiryType::class, $enquiry);
	    //$request = $this->getRequest();
	    if ($request->getMethod() == 'POST') {
	        $form->handleRequest($request);
	        if ($form->isValid()) {
	            $message = \Swift_Message::newInstance()
	            ->setSubject('Contact enquiry from symblog')
	            ->setFrom('enquiries@symblog.co.uk')
	            ->setTo($this->container->getParameter('blogger_blog.emails.departament.'.$enquiry->getDepartament()))
	            //->setCc("manuel@gmail.com")
	            ->setBody($this->renderView('BloggerBlogBundle:Page:contactEmail.txt.twig', array('enquiry' => $enquiry)));
        	$this->get('mailer')->send($message);
        	

        	/*$myfile = fopen(dirname(__DIR__)."/contactLog.txt", "a");
        	fwrite($myfile, date('Y-m-d')."\t".$request->getClientIp()."\t".$enquiry->getName()."\t".$enquiry->getEmail()."\n");
        	fclose($myfile);*/

        	$this->get('session')->getFlashBag()->add('blogger-notice', 'Your contact enquiry was successfully sent. Thank you!');
	        return $this->redirect($this->generateUrl('BloggerBlogBundle_contact'));
	        }
	    }
	    return $this->render('BloggerBlogBundle:Page:contact.html.twig', array(
	        'form' => $form->createView()
	    ));
	}

	public function sidebarAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tagWeights = $em->getRepository('BloggerBlogBundle:Tag')
                         ->getTagsCol();
        $commentLimit   = $this->container->getParameter('blogger_blog.comments.latest_comment_limit');

        $latestComments = $em->getRepository('BloggerBlogBundle:Comment')->getLatestComments($commentLimit);             

        return $this->render('BloggerBlogBundle:Page:sidebar.html.twig', array(
            'tags' => $tagWeights,
        	'latestComments'    => $latestComments
        ));
    }
}
