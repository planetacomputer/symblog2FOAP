<?php
namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Blogger\BlogBundle\Entity\Blog;

/**
 * Controlador del Blog.
 */
class BlogController extends Controller
{


    public function editAction(Request $request){
        $blogId = $request->get('id');
        $em = $this->get('doctrine')->getManager();

        $blog = $em->getRepository('BloggerBlogBundle:Blog')->find($blogId);

        if (!$blog) {
            throw $this->createNotFoundException('No blog found for id '.$blogId);
        }
        $blog->setAuthor("David");
        $em->flush();
        return $this->render('BloggerBlogBundle:Blog:create.html.twig', array('blog' => $blog));    
    }

    public function createAction(Request $request){
        $em = $this->get('doctrine')->getManager();
        $blog = new Blog();
        $blog->setTitle("Lloret de Mar, travel through night");
        $blog->setAuthor("dsyph3r");
        $blog->setBlog("symblog is a fully featured blogging website ...");
        $blog->setTags("estiu begur costa brava platges");
        $blog->setImage("begur.jpg");
        $em->persist($blog);
        $em->flush();
        return $this->render('BloggerBlogBundle:Blog:create.html.twig', array('blog' => $blog));
    }

    /**
     * Muestra una entrada del blog
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $blog = $em->getRepository('BloggerBlogBundle:Blog')->find($id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post');
        }

        $comments = $em->getRepository('BloggerBlogBundle:Comment')
               ->getCommentsForBlog($blog->getId());

        return $this->render('BloggerBlogBundle:Blog:show.html.twig', array('blog'=> $blog, 'comments' => $comments));
    }
}