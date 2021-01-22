<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

/**
 * @Route("/post", name="post.")
 */
class PostController extends AbstractController
{
	/**
	 * @Route("/home", name="home")
	 */
	public function index(PostRepository $postRepository)
	{
		$posts = $postRepository->findAll();
		return $this->render('post/index.html.twig', [
			'posts' => $posts
		]);
	}

	/**
	 * @Route("/show/{id}", name="show")
	 * @return Reponse
	 */
	public function show(Post $post)
	{
		return $this->render('post/show.html.twig', [
			'post' => $post
		]);
	}

	/**
	 * @Route("/create", name="create")
	 * @param Request $request
	 */
	public function create(Request $request)
	{
		$post = new Post();

		$form = $this->createForm(PostType::class, $post);
		$form->handleRequest($request);
		if ($form->isSubmitted()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($post);
			$em->flush();
			return $this->redirect($this->generateUrl('post.home'));
		}

		return $this->render('post/create.html.twig', [
			'form' => $form->createView()
		]);
	}

	/**
	 * @Route("/delete/{id}", name="delete")
	 *
	 */
	public function remove(Post $post)
	{
		$em = $this->getDoctrine()->getManager();
		$em->remove($post);
		$em->flush();
		$this->addFlash('success', 'Post was removed');
		return $this->redirect($this->generateUrl('post.home'));
	}

	/**
	 * @Route("/test", name="test")
	 * @param CacheInterface $cache
	 * @return Reponse
	 */
	public function test(Stopwatch $stopwatch,CacheInterface $cache)
	{
//		$stopwatch->start('calcul-long');
//		dump($stopwatch);
//		$td = $cache->get('resultat-calcul-ong', function (ItemInterface $item){
//			$item->expiresAfter(10);
//			return $this->dateToday();
//		});
//		$stopwatch->stop('calcul-long');


		return $this->render('post/test.html.twig', [

		]);
	}

	function dateToday(): int{
		sleep(2);
		return 10;
	}

}
