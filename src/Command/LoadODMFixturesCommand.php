<?php

namespace App\Command;

use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\ODM\MongoDB\DocumentManager;
use Nelmio\Alice\Loader\NativeLoader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LoadODMFixturesCommand extends Command
{
    private const CMD_NAME = 'load-odm-fixtures';

    /** @var DocumentManager */
    private $documentManager;

    /** @var string */
    private $fixturesFolderPath;

    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct(self::CMD_NAME);

        $this->documentManager = $doctrine->getManager();
        $this->fixturesFolderPath = __DIR__ . '/../../resources/fixtures/';
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $loader = new NativeLoader();
        $objectSet = $loader->loadFiles([
            $this->fixturesFolderPath . 'Workout.CategoryDTO.yaml',
            $this->fixturesFolderPath . 'Workout.WorkoutDTO.yaml',
            $this->fixturesFolderPath . 'User.UserDTO.yaml',
        ]);

        foreach ($objectSet->getObjects() as $key => $object) {
            $output->write("$key creating ...");
            $this->documentManager->persist($object);
            $this->documentManager->flush();

            $output->writeln(" <info>success</info>");
        }


        return 0;
    }
}