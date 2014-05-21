<?php
namespace Robo;

use Symfony\Component\Console\Helper\DialogHelper;
use Symfony\Component\Console\Output\ConsoleOutput;

trait Output {
    protected function say($text)
    {
        $this->writeln("➜  $text");
    }

    protected function yell($text, $length = 40)
    {
        $format = "➜<fg=white;bg=green;options=bold>%s</fg=white;bg=green;options=bold>";
        $text = str_pad($text, $length, ' ', STR_PAD_BOTH);
        $len = strlen($text) + 4;
        $space = str_repeat(' ', $len);
        $this->writeln(sprintf($format, $space));
        $this->writeln(sprintf($format, " $text "));
        $this->writeln(sprintf($format, $space));
    }

    protected function printTaskInfo($text, $task = null)
    {
        if (!$task) $task = $this;
        $this->writeln(" <fg=white;bg=cyan;options=bold>[".get_class($task)."]</fg=white;bg=cyan;options=bold> $text");
    }

    protected function ask($question, $hideAnswer = false)
    {
        $dialog = new DialogHelper();
        if ($hideAnswer) {
            return $dialog->askHiddenResponse($this->getOutput(), "<question>?  $question</question> ");
        } else {
            return $dialog->ask($this->getOutput(), "<question>?  $question</question> ");
        }
    }

    /**
     * @return ConsoleOutput
     */
    protected function getOutput()
    {
        static $output;
        if (!$output) {
            $output = new ConsoleOutput();
        }
        return $output;
    }

    private function writeln($text)
    {
        $this->getOutput()->writeln($text);
    }

}
 