<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*| --------------------------------------------------------------------------
*| Page Controller
*| --------------------------------------------------------------------------
*| For default controller
*|
*/
class Page extends Front
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('simple_html_dom');
	}
	
	/**
	* Index page
	*
	*/
	public function index()
	{
		$this->template->build('home');
	}

	/**
	* Index page
	*
	*/
	public function landing()
	{
		$this->load->model('model_page');
		$page_id = get_option('landing_page_id', 1);

		$page = $this->model_page->find($page_id);

		if ($page) {
			$this->detail($page->link);
		}
	}

	/**
	* Detail page
	*
	* @var String $slug
	*/
	public function detail($slug)
	{

		$this->load->model('model_page');

		$page = $this->model_page->get_page_by_slug($slug, 'frontend');

		if (!$page) {
			show_404();
		}

		$this->register_unparse_html($page);
		$page->content = $this->cc_page_element->unParseHtml($page->content);
		$data['page'] = $page;

		if ($page->template == 'default') {
			$this->template->build('page', $data);
		} else {
			echo $page->content;
		}
	}

	/**
	* Register unparse HTML
	*
	* @var Object $page
	*/
	private function register_unparse_html($page) {

		$this->cc_page_element->registerUnParseHtml(function($html){
			return str_replace('{base_url}', BASE_URL, $html);
		});

		$this->cc_page_element->registerUnParseHtml(function($html){
			return preg_replace('/<div class=".*(.widged-cover).*".*\>/i', '', $html);
		});

		$this->cc_page_element->registerUnParseHtml(function($html){
			$html =  preg_replace_callback(
				'/\{form_builder\(([0-9]{0,11})\)\}/',
				function($matches) {
					if (isset($matches[1])) {
						return form_builder($matches[1]);
					}
				}, $html);

			return $html;
		});


		$this->cc_page_element->registerUnParseHtml(function($html) {
			$html = str_replace('<script_widged class="display-none"','<script', $html);
			$html = str_replace('</script_widged','</script', $html);

			return $html;
		});

		$this->cc_page_element->registerUnParseHtml(function($content) use ($page){
			$script_js['top'] = [];
			$script_js['bottom'] = [];
			$css_top = [];
			$content_template = [];

			$html = str_get_html($content);

			foreach($html->find('cc-element[cc-id=script]') as $scripts) {
			    $scripts_list = str_get_html($scripts->innertext);

			    foreach($scripts_list->find('script') as $script) {
			    	$placement = 'top';

			    	if ($script->placement) {
			    		$placement = $script->placement;
			    	}
			    	if ($script->src) {
			    		$script_js[$placement][$script->src] = $script->outertext;
			    	} else {
			    		$script_js[$placement][] = $script->outertext;
			    	}
			    }

				$scripts_list->outertext = null;
			}

			foreach($html->find('cc-element[cc-id=style]') as $styles) {
				$styles_list = str_get_html($styles->innertext);

			    foreach($styles_list->find('style,link') as $style) {
			    	if ($style->href) {
			    		$css_top[$style->href] = $style->outertext;
			    	} else {
			    		$css_top[] = $style->outertext;
			    	}
			    }

				$styles_list->outertext = null;
			}

			foreach($html->load($html->save())->find('cc-element[cc-id=content]') as $contents) {
			    $content_template[] = $contents->innertext;
				$contents->outertext = null;
			}
			$this->data = [
				'css_top' 		=> $css_top,
				'script_top' 	=> $script_js['top'],
				'script_bottom' => $script_js['bottom'],
				'html_body' 	=> $content_template,
				'title' 		=> $page->title,
				'page'			=> $page
			];

			$render = $this->load->view('core_template/page/page_html_formatter', $this->data, true);

			return $render;
		});
	}
}


/* End of file Page.php */
/* Location: ./application/controllers/Page.php */
