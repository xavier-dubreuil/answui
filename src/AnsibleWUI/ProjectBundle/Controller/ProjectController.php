<?php

namespace AnsibleWUI\ProjectBundle\Controller;

use AnsibleWUI\ProjectBundle\Entity\Project;
use AnsibleWUI\ProjectBundle\Form\Type\ProjectType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ProjectController
 *
 * @package AnsibleWUI\ProjectBundle\Controller
 */
class ProjectController extends Controller
{
    private function getManager()
    {
        return $this->get('project.manager');
    }

    public function getProjectAction($slug)
    {
        $project = $this->getManager()->getRepository()->find($slug);

        return $this->render(
            'AnsibleWUIProjectBundle:Project:view.html.twig',
            [
                'entity' => $project
            ]
        );
    }

    public function getProjectsAction(Request $request)
    {

        $projects = $this->getManager()->getRepository()->findAll();

        return $this->render(
            'AnsibleWUIProjectBundle:Project:list.html.twig',
            [
                'entities' => $projects
            ]
        );
    }

    /**
     * @return Project
     */
    protected function newEntity()
    {
        return new Project();
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    protected function getRepository()
    {
        return $this->getDoctrine()->getRepository('AnsibleWUIProjectBundle:Project');
    }

    /**
     * @return mixed
     */
    protected function formType()
    {
        return ProjectType::class;
    }

    /**
     * @param $object
     */
    protected function prePersist($object)
    {
        /**
         * @var Project $object
         */
        $object->setSlug(strtolower(str_replace(' ', '_', $object->getName())));
    }

    /**
     * @return array
     */
    protected function getRoutes()
    {
        return [
            'list'   => 'ansible_wui_project_list',
            'view'   => 'ansible_wui_project_view',
            'add'    => 'ansible_wui_project_add',
            'edit'   => 'ansible_wui_project_edit',
            'delete' => 'ansible_wui_project_delete',
        ];
    }

    /**
     * @return array
     */
    protected function getTemplates()
    {
        return [
            'list' => 'AnsibleWUIProjectBundle:Project:list.html.twig',
            'form' => 'AnsibleWUIProjectBundle:Project:form.html.twig',
            'view' => 'AnsibleWUIProjectBundle:Project:view.html.twig',
        ];
    }
}
