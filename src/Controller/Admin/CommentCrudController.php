<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use App\Entity\Conference;
use App\Repository\CommentRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    public function getConferences(): array
    {
        $conferences = $this->getDoctrine()->getManager()->getRepository(Conference::class)->findAll();

        $data = [];
        if (!empty($conferences)) {
            foreach ($conferences as $conference) {
                $data[$conference->getCity()] = $conference->getId();
            }
        }

        return $data;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('author'),
            AssociationField::new('conference'),
            TextareaField::new('text'),
            EmailField::new('email'),
        ];
    }

}
