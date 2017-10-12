<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\ORM\EntityManagerInterface;
use InstaParserBundle\Entity\Subscriber;
use InstaParserBundle\Entity\Tag;
use InstaParserBundle\Interaction\Enum\TagType;
use InstaParserBundle\Interaction\Enum\UpdateStatus;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Version20171011225925 extends AbstractMigration implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        /** @var EntityManagerInterface $em */

        $tagEntity = (new Tag())->setType(TagType::WORLD_CLASS);
        $em->persist($tagEntity);

        $handle = fopen(__DIR__ . '/content/trainers.csv', 'r');

        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            $name = trim($data[3]);

            $subscriber = (new Subscriber())
                ->setName($name)
                ->setStatus(UpdateStatus::READY)
                ->setLocation($data[0])
                ->setRealName($data[2])
                ->setWork($data[1])
                ->setLink('https://www.instagram.com/' . $name)
                ->setIsOnPlatform(false)
                ->setUpdatedAt(new \DateTime())
                ->setTags([$tagEntity])
            ;

            $em->persist($subscriber);
        }

        $em->flush();

        fclose($handle);
    }

    /**
     * {@inheritdoc}
     */
    public function down(Schema $schema)
    {

    }
}
