<?php

namespace Master\Core\Console;

use Illuminate\Console\GeneratorCommand;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CoreCommand extends GeneratorCommand
{

	protected $name = 'make:module';

	protected $description = 'Create a new module';


	protected function getStub()
	{
		$stub = array(
			'composer' => array(
				'path' => 'composer.json',
				'link' => __DIR__.'/stubs/composer.stub'
			),
			'serviceprovider' => array(
				'path' => 'src/DummyServiceprovider.php',
				'link' => __DIR__.'/stubs/serviceprovider.stub'
			),
			'config' => array(
				'path' => 'config/config.php',
				'link' => __DIR__.'/stubs/config.stub'
			),
			'migrations' => array(
				'path' => 'database/migrations/'.date('Y_m_d').'_'.strtotime(date('H:i:s')).'_dummy_table.php',
				'link' => __DIR__.'/stubs/tablemigration.stub'
			),
			'facade' => array(
				'path' => 'src/Facades/Dummy.php',
				'link' => __DIR__.'/stubs/facade.stub'
			),
			'controller' => array(
				'path' => 'src/Http/Controllers/DummyResourceController.php',
				'link' => __DIR__.'/stubs/controller.stub'
			),
			'interface' => array(
				'path' => 'src/Interfaces/DummyRepositoryInterface.php',
				'link' => __DIR__.'/stubs/interface.stub'
			),
			'model' => array(
				'path' => 'src/Models/Dummy.php',
				'link' => __DIR__.'/stubs/model.stub'
			),
			'routeprovider' => array(
				'path' => 'src/Providers/RouteServiceProvider.php',
				'link' => __DIR__.'/stubs/routeprovider.stub'
			),
			'criteria' => array(
				'path' => 'src/Repositories/Criteria/DummyCriteria.php',
				'link' => __DIR__.'/stubs/criteria.stub'
			),
			'repository' => array(
				'path' => 'src/Repositories/Eloquent/DummyRepository.php',
				'link' => __DIR__.'/stubs/repository.stub'
			),
			'presenter' => array(
				'path' => 'src/Repositories/Presenter/DummyPresenter.php',
				'link' => __DIR__.'/stubs/presenter.stub'
			),
			'transformer' => array(
				'path' => 'src/Repositories/Presenter/DummyTransformer.php',
				'link' => __DIR__.'/stubs/transformer.stub'
			),
			'sidebar' => array(
				'path' => 'src/Sidebar/ExtenderSidebar.php',
				'link' => __DIR__.'/stubs/sidebar.stub'
			),
			'class' => array(
				'path' => 'src/Dummy.php',
				'link' => __DIR__.'/stubs/class.stub'
			),
			'routes' => array(
				'path' => 'routes/web.php',
				'link' => __DIR__.'/stubs/routes.stub'
			)
		);
		return $stub;
	} 


	public function handle()
	{
		$name = $this->qualifyClass($this->getNameInput());


		$path = $this->getPath($name);   

		$this->makeDirectory($path);
		// paksa buat folder
		$this->makeDirectory($path.'/config');
		$this->makeDirectory($path.'/database/migrations');
		$this->makeDirectory($path.'/resources/lang/en');
		$this->makeDirectory($path.'/resources/lang/id');
		$this->makeDirectory($path.'/resources/views/admin');
		$this->makeDirectory($path.'/resources/views/public');
		$this->makeDirectory($path.'/routes');
		$this->makeDirectory($path.'/src');
		$this->makeDirectory($path.'/src/Facades');
		$this->makeDirectory($path.'/src/Http/Controllers');
		$this->makeDirectory($path.'/src/Interfaces');
		$this->makeDirectory($path.'/src/Models');
		$this->makeDirectory($path.'/src/Providers');
		$this->makeDirectory($path.'/src/Repositories/Criteria');
		$this->makeDirectory($path.'/src/Repositories/Eloquent');
		$this->makeDirectory($path.'/src/Repositories/Presenter');
		$this->makeDirectory($path.'/src/Sidebar');





		$builds = $this->buildClass($name);

		foreach ($builds as $key => $list) {
			$this->files->put($path.'/'.$list['path'], $this->sortImports($list['file']));
		}
	}


	protected function qualifyClass($name)
	{
		$name = ltrim($name, '\\/');

		$rootNamespace = 'module';

		if ($this->option('master')) {
			$rootNamespace = 'master';
		}

		if (Str::startsWith($name, $rootNamespace)) {
			return $name;
		}

		$name = str_replace('/', '\\', $name);

		return $this->qualifyClass(
			$this->getDefaultNamespace(trim($rootNamespace, '\\')).'\\'.$name
		);
	}


	protected function buildClass($name)
	{

	$latestName = $this->getModuleName($name);

	$stubs = $this->getStub();

	$response = array();

	foreach ($stubs as $key => $stubFile) {
		$stub = $this->files->get($stubFile['link']);

		if ($key !== 'composer') {
			$stubFile['path'] = str_replace(['Dummy', 'dummy'], [ucwords($latestName), $latestName], $stubFile['path']); 
		}

		$response[] = array(
			'path' => $stubFile['path'],
			'file' => $this->replaceNamespaces($stub, $name, ($key == 'composer' ? true : false))->replaceClass($stub, $name)
		);
	}
		return $response;
	}



	protected function replaceNamespaces(&$stub, $name, $composer = false)
	{

		$stub = str_replace(
			[
				'DummyNamecomposer', 
				'DummyNamespace', 
				'DummyServiceprovider', 
				'\\',
				'DummyModuleName',
				'DummyModuleFacade',
				'DummyFacadeNamespace',
				'DummyClass'
			],
			[
				($this->option('master') ? 'master' : 'public').'/'.$this->getNameInput(), 
				$this->getNamespace($name), 
				$this->getServiceProvider($name), 
				( (bool)$composer ? '\\\\' : '\\'),
				$this->getModuleName($name),
				$this->getModuleFacade($name),
				$this->getFacadeNamespace($name),
				$this->getClass($name)
			],
			$stub
		);
		
		return $this;
	}

	public function getClass($name)
	{
		$moduleName = ucwords($this->getModuleName($name));
		return $moduleName;
	}


	public function getRepositoryModule($name)
	{
		$moduleName = ucwords($this->getModuleName($name));
		return $moduleName.'Repository';
	}


	public function getRepositoryInterface($name)
	{
		$moduleName = ucwords($this->getModuleName($name));
		return $moduleName.'RepositoryInterface';
	}

	public function getFacadeNamespace($name)
	{
		$namespace = $this->getNamespace($name);
		$moduleName = ucwords($this->getModuleName($name));

		return $namespace.'\\'.$moduleName;
	}

	public function getModuleFacade($name)
	{
		return str_replace('\\', '.', $name);
	}

	public function getModuleName($name)
	{
		$expand = explode('\\', $name);
		return end($expand);
	}


	public function getServiceProvider($name)
	{
		return $this->getNamespace($name).'\\'. ucwords(trim(implode('\\', array_slice(explode('\\', $name), -1)), '\\')) . 'ServiceProvider' ;    
	}


	protected function replaceClass($stub, $name)
	{
		$class = str_replace($this->getNamespace($name).'\\', '', $name);
		return str_replace('DummyClass', $class, $stub);
	}


	protected function getNamespace($name)
	{   
		$data = array();
		foreach (explode('\\', $name) as $key => $value) {
			$data[] = ucwords($value); 
		}
		return trim(implode("\\", $data), '\\');
	}



	protected function getPath($name)
	{  
		$name = Str::replaceFirst($this->rootNamespace(), '', $name);

		$parent = Str::replaceFirst('app', '', $this->laravel['path']);

		return $parent.str_replace('\\', '/', $name);
	}


	protected function makeDirectory($path)
	{
		if (! $this->files->isDirectory($path)) {
			$this->files->makeDirectory($path, 0777, true, false);
		}
		return $path;
	}


  protected function getOptions()
  {
    return [
      ['master', 'm', InputOption::VALUE_NONE, 'Generate a migration, factory, and resource controller for the model']
    ];
  }
}
