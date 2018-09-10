<?php
/**
 * Cool module for display difference in schema between DB and SQL script
 *
 */
class Dbdiff extends BaseController 
{
	protected $_title = 'Database Diff Tool';
	protected $_maintpl = 'admin';
	
	public function index()
	{
		$this->v->display('dbdiff');
	}
	
	/**
	 * Create dump
	 *
	 */
	public function dump()
	{
		$dump_array = $this->m->getDumpFromDb();
		$this->v->makeDumpFile($dump_array);
	}
	
	/**
	 * Display difference between diven file and internal db
	 *
	 */
	public function diff()
	{
		if (is_uploaded_file(self::$_files['attachment']['tmp_name'])) 
		{
			$filedump = $this->m->getDumpFromFile(self::$_files['attachment']['tmp_name']);
			$dbdump = $this->m->getDumpFromDb();
			
			$this->v->displaySQL($dbdump, $filedump);
		}
		else 
		{
			$this->v->script = 'File not uploaded';
			$this->v->display('dbdiff');
		}
	}
	
	/**
	 * Execute SQL query;
	 *
	 */
	public function execSQL()
	{
		$sql = $this->_post('sql');
		$sql = stripslashes(preg_replace('~<br[ \/]*>~i', ' ', $sql));
		$this->m->execSQL($sql);
		$this->v->assign('success',true);
	}
}