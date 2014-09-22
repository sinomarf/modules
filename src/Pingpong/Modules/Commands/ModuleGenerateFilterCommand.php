<?php namespace Pingpong\Modules\Commands;

use Pingpong\Modules\Stub;
use Illuminate\Support\Str;
use Pingpong\Modules\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class ModuleGenerateFilterCommand
 * @package Pingpong\Modules\Commands
 */
class ModuleGenerateFilterCommand extends GeneratorCommand {

	use ModuleCommandTrait;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'module:filter-make';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate new filter for the specified module.';

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('name', InputArgument::REQUIRED, 'The name of the command.'),
			array('module', InputArgument::OPTIONAL, 'The name of module will be used.'),
		);
	}

    /**
     * @return mixed
     */
    protected function getTemplateContents()
    {
        return new Stub('filter', [
            'MODULE'        =>  $this->getModuleName(),
            'NAME'          =>  $this->getFileName()
        ]);
    }

    /**
     * @return mixed
     */
    protected function getDestinationFilePath()
    {
        $path = $this->laravel['modules']->getModulePath($this->getModuleName());

        $seederPath = $this->laravel['config']->get('modules::paths.generator.filter');

        return $path . $seederPath . '/' . $this->getFileName() . '.php';
    }

    /**
     * @return string
     */
    private function getFileName()
    {
        return Str::studly($this->argument('name'));
    }

}