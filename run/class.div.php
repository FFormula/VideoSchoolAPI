<?php

namespace run;

use \system;

class div
{
    private $parts;
    private $class;
    private $method;

    /**
     * @var array - list of all address templates and relation to the functions
     * summary:
     * x - any text [a-z0-9]+
     * 1 - any number [0-9]+
     * / split parameters
     */
    private $router = array (
        "news" => array (
            array ("", "list_all_news"),        //news
            array ("x", "list_news_of_type"),   //news/reports
            array ("x/x", "info_of_type()")    //news/reports/4004.Elena-DesignPatterns-Singleton
        ),

        "shop" => array (
            array ("", "list_all_packets"),     //shop
            array ("x", "about_packet"),        //shop/game1
            array ("x/bill", "bill_packet"),    //shop/game1/bill
            array ("x/start", "start_packet"),  //shop/game1/start
            array ("x/video", "list_all_video_reports_for_packet"), //shop/game1/video
            array ("x/reports", "list_all_reports_for_packet"), //shop/game1/reports
            array ("x/reports/x", "list_all_reports_of_lesson_for_packet"), //shop/game1/reports/Igra-15
            array ("x/lessons", "list_all_lessons_for_packet"), //shop/game1/lessons
            array ("x/posts", "list_all_posts_for_packet") //shop/game1/posts
        ),

        "user" => array (
            array ("", "list_all_people"),           //user
            array ("best", "list_of_best_students"), //user/best
            array ("best/week",       "list_of_best_student_for_this_week"), //user/best/week
            array ("best/week/y-m-d", "list_of_best_student_for_spec_week"), //user/best/week/2017-01-02
            array ("club", "list_of_club_students"), //user/club
            array ("x", "show_user_info"), //user/vev
        ),

        "help" => array (
            array ("", "about_project"),
            array ("ask", "ask_question"),
            array ("ask/x", "show_question"),
            array ("faq", "show_faq"),
            array ("rules", "show_rules"),
            array ("x", "list_of_items"),
            array ("x/x", "show_item"),
        ),

        "me" => array (
            array ("", "user_home"),
            array ("join", "join_user"),
            array ("login", "login_user"),
            array ("login/repassword", "change_password"),
            array ("edit", "show_edits"),
            array ("edit/x", "edit_page"),
            array ("post", "show_all_posts"),
            array ("stat", "show_main_stats"),
            array ("stat/x", "show_stat_page")
        )
    );

    public function __construct()
    {
        $this->init_parts();
        $this->init_class();
        $this->method = $this->find_method();
    }

    private function init_parts ()
    {
        if (isset ($_GET [DATA_GET]))
            $this -> parts = explode ('/', trim($_GET [DATA_GET], '\\/'));
        else
            $this -> parts = array ();
    }

    private function init_class ()
    {
        if (!isset ($this->parts[0]))
            $this->class = DIVS_DEFAULT_CLASS;
        else
            $this->class = $this->parts [0];
    }

    private function find_method ()
    {
        print_r ($this->parts); echo "<br>";
        if (!isset($this->router[$this->class]))
            return DIVS_DEFAULT_METHOD;
        foreach ($this->router[$this->class] as $item)
            if ($this->admit($item[0]))
                return $this->method = $item[1];
        return DIVS_DEFAULT_METHOD;
    }

    protected function admit ($rule)
    {
        $rule_items = explode ("/", trim($rule, "/"));
        if (count($this->parts) > count ($rule_items))
            return false;
        $j = 1;
        foreach ($rule_items as $item)
        {
            if ($j >= count($this->parts))
                return false;
            if (!$this->like($item, $this->parts[$j++]))
                return false;
        }
        echo $rule . "<br>";
        return true;
    }

    protected function like ($item, $part)
    {
        echo "$item == $part ?";
        if ($item == $part) return true;
        if ($item == "x" && system\text::is_alpha($part)) return true;
        echo "no<br>";
        return false;
    }

    public function run ()
    {
        $this->error = "";
        if (!system\text::is_alpha($this->class))
            return $this->set_error ("incorrect symbols in class param");
        $class = "\\div\\" . $this->class;

        echo "<br> class/method: " . $class . " -> " . $this->method . " ()";
        return;

        try {
            $div = new $class ($this->parts);
        } catch (\Exception $e) {
            return $this->set_error ("class " . $class . " not found");
        }

        if (!system\text::is_alpha($this->method))
            return $this->set_error ("incorrect symbols in method param");
        $method = $this->method;

        if (!is_callable(array ($div, $method)))
            return $this->set_error ("api class/method not found: " . $class . "/" . $method);

        if (!$div->$method ())
            return $this->set_error ($div->get_error());

        return $div->get_packet ();
    }

    protected $error = "";
    public function get_error () { return $this->error; }
    protected function set_error ($message) { $this->error = $message; return false; }
}