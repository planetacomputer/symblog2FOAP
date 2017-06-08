<?php
// src/Blogger/BlogBundle/Form/EnquiryType.php
namespace Blogger\BlogBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EnquiryType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('name', TextType::class, array('label'  => 'El teu nom'));
        $builder->add('email', EmailType::class);
        $builder->add('subject');
        $builder->add('body', TextareaType::class, array('label'  => 'Missatge'));
        $builder->add('departament', ChoiceType::class, array(
	    	'choices'  => array(
	        'Marketing' => 'marketing',
	        'Tecnic' => 'tecnic',
	        'Comptabilitat' => 'comptabilitat',
        	),
	    ));
    }
    public function getName(){
        return 'contact';
    }
}