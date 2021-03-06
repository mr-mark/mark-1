<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of mainController
 *
 * @author mark
 */
class MainController extends Controller {

    protected $data = array();
    protected $controller_name;
    protected $action_name;

    function MainController()
    {
        parent::Controller();

        $this->load->language('titles', get_lang());
        $this->load->language('labels', get_lang());
        $this->load->language('errors', get_lang());

	$this->load->helper('url');

        $this->load_defaults();
    }

    protected function load_defaults()
    {
        $this->data['heading'] = 'Page Heading';
        $this->data['content'] = '';
        $this->data['css'] = '';
        $this->data['base_img'] = css_url()."system/application/assets/images/";
        $this->data['avatar_img'] = "../assets/images/";
        $this->data['title'] = 'Page Title';
        $this->data['lang'] = $this->lang->language;

//        $this->add_css('main');
//        $this->loadJs('jquery');
//        $this->loadJs('boxy');

        $this->controller_name = $this->router->fetch_directory() . $this->router->fetch_class();
        $this->action_name = $this->router->fetch_method();

    }

    protected function render($template='main')
    {
        $view_path = $this->controller_name . '/' . $this->action_name . '.tpl.php';
        if (file_exists(APPPATH . 'views/' . $view_path)) {
                $this->data['content'] .= $this->load->view($view_path, $this->data, true);
        }
        $this->load->view("layouts/$template.tpl.php", $this->data);
    }

    protected function add_css($filename)
    {
        $this->data['css'] .= $this->load->view("partials/css.tpl.php", array('filename' => $filename), true);
    }

    protected function loadJs($filename)
    {
        $this->data['js'] .= $this->load->view("partials/js.tpl.php", array('filename' => $filename), true);
    }

    function error_reporter($type, $params = null , $template='main',$specialCss = null)
    {
        //$this->loadJs('boxy');

        if(!$specialCss)
            $this->add_css('boxy');
        else
            $this->add_css($specialCss);


        $this->data['params'] = $params;
        $this->data['content'] = $this->load->view("layouts/error/$type.tpl.php", $this->data, TRUE);

        $this->load->view("layouts/error/$template.tpl.php", $this->data);
    }


    function refresh_page()
    {
        $this->load->view("partials/refresh.tpl.php");
    }

    function js_redirect($path)
    {
        $this->load->view("partials/redirect.tpl.php", array('path' => $path));
    }

    function newestUser($type,$offset = 0,$limit = 16)
    {
        $this->data['users'] = $this->user_model->get_newest_users($offset,$limit);
        $this->data['type'] = $type;
        $this->data['page'] = $offset;
        return $this->load->view("home/topUser.tpl.php", $this->data,true);
    }

    function topestUser($type,$offset= 0,$limit = 16)
    {
        $this->load->model(array('Userrank'));
        $usrrnkMdl = new Userrank();
        $users = $usrrnkMdl->getBestUser(16);
        $counter = count($users);
        if($counter < 16)
        {
            $limitHolder = 16 - $counter;

            $sql = "SELECT * FROM `farms` WHERE disactive = 0 order by level desc limit ".$limitHolder.";";
            $result = $this->db->query($sql)->result_array();

            foreach($result AS $farm)
            $users[] = $this->user_model->get_user_by_id($farm['user_id']);
        }
//        var_dump($users);exit;
        $this->data['type'] = $type;
        $this->data['users'] = $users;
        return $this->load->view("home/topUser.tpl.php", $this->data,true);
    }
    //this function check that action requested for authenticated user is actualy is for logged user
    function is_logged_user($user_id)
    {
        if(($user_id != $this->userSessionHolder->id) || ($user_id == ""))
            redirect(base_url()."message/index/21");
    }
}
?>