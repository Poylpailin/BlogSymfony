<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;


/**
 * User controller.
 *
 * @Route("/user")
 */
class userController extends Controller
{
    /**
     * Lists all Users entities.
     *
     * @Route("/", name="user")
     *
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();
        return $this->render('AppBundle:User:index.html.twig', [
            'users' => $users,
        ]);
    }
    /**
     * Creates a new User entity.
     *
     * @Route("/create", name="user_create")
     *
     * @Method("GET|POST")
     */
    public function createAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(new UserType(), $user, array(
            'action' => $this->generateUrl('user_create'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Create'));
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->render($this->generateUrl('user_show', array('id' => $user->getId())));
        }
        return $this->render('AppBundle:User:new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
    /**
     * Finds and displays a User entity.
     *
     * @Route("/{id}", name="user_show")
     *
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);
        if (!$user) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        $deleteForm = $this->createDeleteForm($id);
        return $this->render('AppBundle:User:show.html.twig', [
            'user'      => $user,
            'delete_form' => $deleteForm->createView(),
        ]);
    }
    /**
     * Edits an existing User entity.
     *
     * @Route("/update/{id}", name="user_update")
     *
     * @Method("GET|PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);
        if (!$user) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new UserType(), $user, array(
            'action' =>$this->generateUrl('user_update', array('id' => $user->getId())),
            'method' => 'PUT',
        ));
        $editForm->add('submit', 'submit', array('label' => 'Update'));
        $editForm->handleRequest($request);
        if ($editForm->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('user_show', array('id' => $id)));
        }
        return $this->render('AppBundle:User:edit.html.twig', [
            'user'      => $user,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }
    /**
     * Deletes a User entity.
     *
     * @Route("/{id}", name="user_delete")
     *
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:User')->find($id);
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }
            $em->remove($entity);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('user'));
    }
    /**
     * Creates a form to delete a User entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }
}