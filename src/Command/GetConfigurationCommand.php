<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Repository\SettingRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Console\Helper\Table;

class GetConfigurationCommand extends Command
{
    protected static $defaultName = 'settings:debug';

    private $objectManager;

    public function __construct(SettingRepository $settingRepository)
    {
        parent::__construct();
        $this->settingRepository = $settingRepository;
    }

    protected function configure()
    {
        $this
            ->setName('settings:debug')
            ->setDescription('Dump all configurations keys')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Key of the setting')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        $settings = $this->settingRepository->findAllAsArray();

        if(empty($settings)){
            $io->error('No settings at this time');
        }else{
            $table = new Table($output);
            $table
                ->setHeaders(['ID','Key', 'Value'])
                ->setRows($settings)
            ;
            $table->render();
        }

    }

    protected function settingsTable($settings){

    }
}
