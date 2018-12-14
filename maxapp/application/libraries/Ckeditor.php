<?php

class Ckeditor
{
	const version = '3.6.1';
	const timestamp = 'B5GJ5GG';

	public $basePath;
	public $config				=	array();
	public $toolbar				=	NULL;
	public $initialized			=	false;
	public $returnOutput		=	false;
	public $textareaAttributes	=	array("rows"=>8, "cols"=>60);
	public $timestamp			=	"B5GJ5GG";
	private $events				=	array();
	private $globalEvents		=	array();

	function __construct($basePath = null) {
		if (!empty($basePath)) {
			$this->basePath = $basePath;
		}
	}

	public function show($id_class = NULL, $config = NULL) {
		$this->basePath				=	base_url() . 'assets/painel/ckeditor/';

		if(!is_null($config) && array_key_exists("toolbar", $config)) {
			$this->toolbar			=	$config['toolbar'];
			unset($config['toolbar']);
		} else {
			$this->toolbar			=	'full';
		}

		$toolbar_item['full']		=	array(
				array(
						'Source', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'Bold', 'Italic', 'Underline', '-', 'Cut', 'Copy', 'PasteText',
						'PasteFromWord', '-', 'Undo', 'Redo', '-', 'NumberedList', 'BulletedList', 'Iframe'
				),
				array(
						'RemoveFormat', '-', 'Link','Unlink','Anchor', '-', 'Image','Flash', '-',
						'Font', 'FontSize', 'TextColor', 'BGColor'
				)
		);
		$toolbar_item['basic']		=	array(
				array(
						'Bold', 'Italic', 'Underline', '-', 'Cut', 'Copy', 'PasteText',
						'PasteFromWord', '-', 'Undo', 'Redo', '-', 'NumberedList', 'BulletedList', 
						'RemoveFormat', 'Link', 'Unlink'
				)
		);

		foreach($config as $name_config => $value_config) {
			$this->config[$name_config]		=	$value_config;
		}

		$this->config['toolbar']			=	$toolbar_item[$this->toolbar];
		$this->config['language']			=	'pt-br';
		$this->config['skin']				=	'kama';
		$this->config['uiColor']			=	'#cccccc'; //#225d8b

		$this->config['filebrowserBrowseUrl']		=	base_url() . 'assets/painel/kcfinder/browse.php?type=files';
		$this->config['filebrowserImageBrowseUrl']	=	base_url() . 'assets/painel/kcfinder/browse.php?type=images';
		$this->config['filebrowserFlashBrowseUrl']	=	base_url() . 'assets/painel/kcfinder/browse.php?type=flash';
		$this->config['filebrowserUploadUrl']		=	base_url() . 'assets/painel/kcfinder/upload.php?type=files';
		$this->config['filebrowserImageUploadUrl']	=	base_url() . 'assets/painel/kcfinder/upload.php?type=images';
		$this->config['filebrowserFlashUploadUrl']	=	base_url() . 'assets/painel/kcfinder/upload.php?type=flash';
		return $this->replaceAll($id_class);
	}

	public function run($id_class = NULL, $toolbar = 'full', $width = '80%', $height = '300px'){
		$this->basePath				=	base_url() . 'assets/painel/ckeditor/';

		$toolbar_item['full']		=	array(
				array(
						'Source', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'Bold', 'Italic', 'Underline', '-', 'Cut', 'Copy', 'PasteText',
						'PasteFromWord', '-', 'Undo', 'Redo', '-', 'NumberedList', 'BulletedList', 'Iframe'
				),
				array(
						'RemoveFormat', '-', 'Link','Unlink','Anchor', '-', 'Image','Flash', '-',
						'Font', 'FontSize', 'TextColor', 'BGColor'
				)
		);
		$toolbar_item['basic']		=	array(
				array(
						'Bold', 'Italic', 'Underline', '-', 'Cut', 'Copy', 'PasteText',
						'PasteFromWord', '-', 'Undo', 'Redo', '-', 'NumberedList', 'BulletedList', 
						'RemoveFormat', 'Link', 'Unlink'
				)
		);

		$this->config['toolbar']			=	$toolbar_item[$toolbar];
		//$this->config['toolbarLocation']	=	$toolbarLocation;
		$this->config['language']			=	'pt-br';
		$this->config['width']				=	$width;
		$this->config['height']				=	$height;
		$this->config['skin']				=	'kama';
		$this->config['uiColor']			=	'#cccccc'; //#225d8b

		$this->config['filebrowserBrowseUrl']		=	base_url() . 'assets/painel/kcfinder/browse.php?type=files';
		$this->config['filebrowserImageBrowseUrl']	=	base_url() . 'assets/painel/kcfinder/browse.php?type=images';
		$this->config['filebrowserFlashBrowseUrl']	=	base_url() . 'assets/painel/kcfinder/browse.php?type=flash';
		$this->config['filebrowserUploadUrl']		=	base_url() . 'assets/painel/kcfinder/upload.php?type=files';
		$this->config['filebrowserImageUploadUrl']	=	base_url() . 'assets/painel/kcfinder/upload.php?type=images';
		$this->config['filebrowserFlashUploadUrl']	=	base_url() . 'assets/painel/kcfinder/upload.php?type=flash';
		return $this->replaceAll($id_class);
	}

	/**
	 * Creates a %CKEditor instance.
	 * In incompatible browsers %CKEditor will downgrade to plain HTML &lt;textarea&gt; element.
	 *
	 * @param $name (string) Name of the %CKEditor instance (this will be also the "name" attribute of textarea element).
	 * @param $value (string) Initial value (optional).
	 * @param $config (array) The specific configurations to apply to this editor instance (optional).
	 * @param $events (array) Event listeners for this editor instance (optional).
	 *
	 * Example usage:
	 * @code
	 * $CKEditor = new CKEditor();
	 * $CKEditor->editor("field1", "<p>Initial value.</p>");
	 * @endcode
	 *
	 * Advanced example:
	 * @code
	 * $CKEditor = new CKEditor();
	 * $config = array();
	 * $config['toolbar'] = array(
	 *     array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
	 *     array( 'Image', 'Link', 'Unlink', 'Anchor' )
	 * );
	 * $events['instanceReady'] = 'function (ev) {
	 *     alert("Loaded: " + ev.editor.name);
	 * }';
	 * $CKEditor->editor("field1", "<p>Initial value.</p>", $config, $events);
	 * @endcode
	 */
	public function editor($name, $id, $value = "", $config = array(), $events = array())
	{
		$attr = "";
		foreach ($this->textareaAttributes as $key => $val) {
			$attr.= " " . $key . '="' . str_replace('"', '&quot;', $val) . '"';
		}
		$out = "<textarea name=\"" . $name . "\" id=\"" . $id . "\"" . $attr . ">" . htmlspecialchars($value) . "</textarea>\n";
		if (!$this->initialized) {
			$out .= $this->init();
		}

		$_config = $this->configSettings($config, $events);

		$js = $this->returnGlobalEvents();
		if (!empty($_config))
			$js .= "CKEDITOR.replace('".$name."', ".$this->jsEncode($_config).");";
		else
			$js .= "CKEDITOR.replace('".$name."');";

		$out .= $this->script($js);

		if (!$this->returnOutput) {
			print $out;
			$out = "";
		}

		return $out;
	}

	/**
	 * Replaces a &lt;textarea&gt; with a %CKEditor instance.
	 *
	 * @param $id (string) The id or name of textarea element.
	 * @param $config (array) The specific configurations to apply to this editor instance (optional).
	 * @param $events (array) Event listeners for this editor instance (optional).
	 *
	 * Example 1: adding %CKEditor to &lt;textarea name="article"&gt;&lt;/textarea&gt; element:
	 * @code
	 * $CKEditor = new CKEditor();
	 * $CKEditor->replace("article");
	 * @endcode
	 */
	public function replace($id, $config = array(), $events = array())
	{
		$out = "";
		if (!$this->initialized) {
			$out .= $this->init();
		}

		$_config = $this->configSettings($config, $events);

		$js = $this->returnGlobalEvents();
		if (!empty($_config)) {
			$js .= "CKEDITOR.replace('".$id."', ".$this->jsEncode($_config).");";
		}
		else {
			$js .= "CKEDITOR.replace('".$id."');";
		}
		$out .= $this->script($js);

		if (!$this->returnOutput) {
			print $out;
			$out = "";
		}

		return $out;
	}

	/**
	 * Replace all &lt;textarea&gt; elements available in the document with editor instances.
	 *
	 * @param $className (string) If set, replace all textareas with class className in the page.
	 *
	 * Example 1: replace all &lt;textarea&gt; elements in the page.
	 * @code
	 * $CKEditor = new CKEditor();
	 * $CKEditor->replaceAll();
	 * @endcode
	 *
	 * Example 2: replace all &lt;textarea class="myClassName"&gt; elements in the page.
	 * @code
	 * $CKEditor = new CKEditor();
	 * $CKEditor->replaceAll( 'myClassName' );
	 * @endcode
	 */
	public function replaceAll($className = null)
	{
		$out = "";
		if (!$this->initialized) {
			$out .= $this->init();
		}

		$_config = $this->configSettings();

		$js = $this->returnGlobalEvents();
		if (empty($_config)) {
			if (empty($className)) {
				$js .= "CKEDITOR.replaceAll();";
			}
			else {
				$js .= "CKEDITOR.replaceAll('".$className."');";
			}
		}
		else {
			$classDetection = "";
			$js .= "CKEDITOR.replaceAll( function(textarea, config) {\n";
			if (!empty($className)) {
				$js .= "	var classRegex = new RegExp('(?:^| )' + '". $className ."' + '(?:$| )');\n";
				$js .= "	if (!classRegex.test(textarea.className))\n";
				$js .= "		return false;\n";
			}
			$js .= "	CKEDITOR.tools.extend(config, ". $this->jsEncode($_config) .", true);";
			$js .= "} );";

		}

		$out .= $this->script($js);

		if (!$this->returnOutput) {
			print $out;
			$out = "";
		}

		return $out;
	}

	/**
	 * Adds event listener.
	 * Events are fired by %CKEditor in various situations.
	 *
	 * @param $event (string) Event name.
	 * @param $javascriptCode (string) Javascript anonymous function or function name.
	 *
	 * Example usage:
	 * @code
	 * $CKEditor->addEventHandler('instanceReady', 'function (ev) {
	 *     alert("Loaded: " + ev.editor.name);
	 * }');
	 * @endcode
	 */
	public function addEventHandler($event, $javascriptCode)
	{
		if (!isset($this->events[$event])) {
			$this->events[$event] = array();
		}
		// Avoid duplicates.
		if (!in_array($javascriptCode, $this->events[$event])) {
			$this->events[$event][] = $javascriptCode;
		}
	}

	/**
	 * Clear registered event handlers.
	 * Note: this function will have no effect on already created editor instances.
	 *
	 * @param $event (string) Event name, if not set all event handlers will be removed (optional).
	 */
	public function clearEventHandlers($event = null)
	{
		if (!empty($event)) {
			$this->events[$event] = array();
		}
		else {
			$this->events = array();
		}
	}

	/**
	 * Adds global event listener.
	 *
	 * @param $event (string) Event name.
	 * @param $javascriptCode (string) Javascript anonymous function or function name.
	 *
	 * Example usage:
	 * @code
	 * $CKEditor->addGlobalEventHandler('dialogDefinition', 'function (ev) {
	 *     alert("Loading dialog: " + ev.data.name);
	 * }');
	 * @endcode
	 */
	public function addGlobalEventHandler($event, $javascriptCode)
	{
		if (!isset($this->globalEvents[$event])) {
			$this->globalEvents[$event] = array();
		}
		// Avoid duplicates.
		if (!in_array($javascriptCode, $this->globalEvents[$event])) {
			$this->globalEvents[$event][] = $javascriptCode;
		}
	}

	/**
	 * Clear registered global event handlers.
	 * Note: this function will have no effect if the event handler has been already printed/returned.
	 *
	 * @param $event (string) Event name, if not set all event handlers will be removed (optional).
	 */
	public function clearGlobalEventHandlers($event = null)
	{
		if (!empty($event)) {
			$this->globalEvents[$event] = array();
		}
		else {
			$this->globalEvents = array();
		}
	}

	/**
	 * Prints javascript code.
	 *
	 * @param string $js
	 */
	private function script($js)
	{
		$out = "<script type=\"text/javascript\">";
		$out .= "//<![CDATA[\n";
		$out .= $js;
		$out .= "\n//]]>";
		$out .= "</script>\n";

		return $out;
	}

	/**
	 * Returns the configuration array (global and instance specific settings are merged into one array).
	 *
	 * @param $config (array) The specific configurations to apply to editor instance.
	 * @param $events (array) Event listeners for editor instance.
	 */
	private function configSettings($config = array(), $events = array())
	{
		$_config = $this->config;
		$_events = $this->events;

		if (is_array($config) && !empty($config)) {
			$_config = array_merge($_config, $config);
		}

		if (is_array($events) && !empty($events)) {
			foreach ($events as $eventName => $code) {
				if (!isset($_events[$eventName])) {
					$_events[$eventName] = array();
				}
				if (!in_array($code, $_events[$eventName])) {
					$_events[$eventName][] = $code;
				}
			}
		}

		if (!empty($_events)) {
			foreach($_events as $eventName => $handlers) {
				if (empty($handlers)) {
					continue;
				}
				else if (count($handlers) == 1) {
					$_config['on'][$eventName] = '@@'.$handlers[0];
				}
				else {
					$_config['on'][$eventName] = '@@function (ev){';
					foreach ($handlers as $handler => $code) {
						$_config['on'][$eventName] .= '('.$code.')(ev);';
					}
					$_config['on'][$eventName] .= '}';
				}
			}
		}

		return $_config;
	}

	/**
	 * Return global event handlers.
	 */
	private function returnGlobalEvents()
	{
		static $returnedEvents;
		$out = "";

		if (!isset($returnedEvents)) {
			$returnedEvents = array();
		}

		if (!empty($this->globalEvents)) {
			foreach ($this->globalEvents as $eventName => $handlers) {
				foreach ($handlers as $handler => $code) {
					if (!isset($returnedEvents[$eventName])) {
						$returnedEvents[$eventName] = array();
					}
					// Return only new events
					if (!in_array($code, $returnedEvents[$eventName])) {
						$out .= ($code ? "\n" : "") . "CKEDITOR.on('". $eventName ."', $code);";
						$returnedEvents[$eventName][] = $code;
					}
				}
			}
		}

		return $out;
	}

	/**
	 * Initializes CKEditor (executed only once).
	 */
	private function init()
	{
		static $initComplete;
		$out = "";

		if (!empty($initComplete)) {
			return "";
		}

		if ($this->initialized) {
			$initComplete = true;
			return "";
		}

		$args = "";
		$ckeditorPath = $this->ckeditorPath();

		if (!empty($this->timestamp) && $this->timestamp != "%"."TIMESTAMP%") {
			$args = '?t=' . $this->timestamp;
		}

		// Skip relative paths...
		if (strpos($ckeditorPath, '..') !== 0) {
			$out .= $this->script("window.CKEDITOR_BASEPATH='". $ckeditorPath ."';");
		}

		$out .= "<script type=\"text/javascript\" src=\"" . $ckeditorPath . 'ckeditor.js' . $args . "\"></script>\n";

		$extraCode = "";
		if ($this->timestamp != self::timestamp) {
			$extraCode .= ($extraCode ? "\n" : "") . "CKEDITOR.timestamp = '". $this->timestamp ."';";
		}
		if ($extraCode) {
			$out .= $this->script($extraCode);
		}

		$initComplete = $this->initialized = true;

		return $out;
	}

	/**
	 * Return path to ckeditor.js.
	 */
	private function ckeditorPath()
	{
		if (!empty($this->basePath)) {
			return $this->basePath;
		}

		/**
		 * The absolute pathname of the currently executing script.
		 * Note: If a script is executed with the CLI, as a relative path, such as file.php or ../file.php,
		 * $_SERVER['SCRIPT_FILENAME'] will contain the relative path specified by the user.
		 */
		if (isset($_SERVER['SCRIPT_FILENAME'])) {
			$realPath = dirname($_SERVER['SCRIPT_FILENAME']);
		}
		else {
			/**
			 * realpath - Returns canonicalized absolute pathname
			 */
			$realPath = realpath( './' ) ;
		}

		/**
		 * The filename of the currently executing script, relative to the document root.
		 * For instance, $_SERVER['PHP_SELF'] in a script at the address http://example.com/test.php/foo.bar
		 * would be /test.php/foo.bar.
		 */
		$selfPath = dirname($_SERVER['PHP_SELF']);
		$file = str_replace("\\", "/", __FILE__);

		if (!$selfPath || !$realPath || !$file) {
			return "/ckeditor/";
		}

		$documentRoot = substr($realPath, 0, strlen($realPath) - strlen($selfPath));
		$fileUrl = substr($file, strlen($documentRoot));
		$ckeditorUrl = str_replace("ckeditor_php5.php", "", $fileUrl);

		return $ckeditorUrl;
	}

	/**
	 * This little function provides a basic JSON support.
	 *
	 * @param mixed $val
	 * @return string
	 */
	private function jsEncode($val)
	{
		if (is_null($val)) {
			return 'null';
		}
		if (is_bool($val)) {
			return $val ? 'true' : 'false';
		}
		if (is_int($val)) {
			return $val;
		}
		if (is_float($val)) {
			return str_replace(',', '.', $val);
		}
		if (is_array($val) || is_object($val)) {
			if (is_array($val) && (array_keys($val) === range(0,count($val)-1))) {
				return '[' . implode(',', array_map(array($this, 'jsEncode'), $val)) . ']';
			}
			$temp = array();
			foreach ($val as $k => $v){
				$temp[] = $this->jsEncode("{$k}") . ':' . $this->jsEncode($v);
			}
			return '{' . implode(',', $temp) . '}';
		}
		// String otherwise
		if (strpos($val, '@@') === 0)
			return substr($val, 2);
		if (strtoupper(substr($val, 0, 9)) == 'CKEDITOR.')
			return $val;

		return '"' . str_replace(array("\\", "/", "\n", "\t", "\r", "\x08", "\x0c", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'), $val) . '"';
	}
}