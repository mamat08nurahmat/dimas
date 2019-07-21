<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Exception as BaseException;
use Whoops\Handler\JsonResponseHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class My_Exceptions extends CI_Exceptions
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show_exception($exception) 
    {
        throw new BaseException($exception);
    }

    public function show_php_error($severity, $message, $filepath, $line) 
    {
        $run     = new Run();
        $handler = new PrettyPageHandler();
        $handler->setApplicationPaths([$filepath]);
        $handler->addDataTable($message, [
            'file' => $filepath,
            'line' => $line,
        ]);

        $handler->setApplicationPaths([$filepath]);
        $handler->addDataTableCallback('Details', function(\Whoops\Exception\Inspector $inspector) {
            $data = array();
            $exception = $inspector->getException();
            if ($exception instanceof SomeSpecificException) {
                $data['Important exception data'] = $exception->getSomeSpecificData();
            }
            $data['Exception class'] = get_class($severity);
            $data['Exception code'] = $exception->getCode();
            return $data;
        });
        $run->pushHandler($handler);
        // Example: tag all frames inside a function with their function name
        $run->pushHandler(function ($exception, $inspector, $run) {
            $inspector->getFrames()->map(function ($frame) {
                if ($function = $frame->getFunction()) {
                    $frame->addComment("This frame is within function '$function'", 'cpt-obvious');
                }
                return $frame;
            });
        });
        
        if (\Whoops\Util\Misc::isAjaxRequest()) {
            $jsonHandler = new JsonResponseHandler();
            $jsonHandler->setJsonApi(true);
            $whoops->pushHandler($jsonHandler);
        }


        $run->register();

        throw new BaseException($message);
    }

}

/* End of file My_Exception.php */
/* Location: ./application/core/My_Exception.php */