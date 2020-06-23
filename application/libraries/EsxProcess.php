<?php 

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\PhpProcess;

class EsxProcess
{
    public function pull()
    {
        //$process = new Process(['ls '. dirname(__FILE__) ]);
        $process = new Process(['C:\Program Files\Git\bin\git.exe git status']);

        try {
            $process->mustRun();

            echo $process->getOutput();
        } catch (ProcessFailedException $e) {
            echo $e->getMessage();
        }
    }
    public function prueba()
    {

        $process = new PhpProcess(<<<EOF
            <?php echo 'Hello World'; ?>
        EOF
        );
        $process->run();
        echo $process->getOutput();
    }

}