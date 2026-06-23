<?php

namespace Training\ProductQa\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Training\ProductQa\Model\QuestionService;

class ProductQaListCommand extends Command
{
    private QuestionService $questionService;
    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('productqa:list');
        $this->setDescription('List of Product QA questions');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $questions = $this->questionService->getQuestions();

        foreach ($questions as $q) {
            $output->writeln($q);
        }

        return Command::SUCCESS;
    }
}
