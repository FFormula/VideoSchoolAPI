<?php

namespace run;

use \system;

class div
{
    private $bars;
    private $class;
    private $method;
    private $args;

    /**
     * @var array - list of all address templates and relation to the functions
     * summary:
     * x - any text [a-z0-9]+
     * 1 - any number [0-9]+
     * / split parameters
     */
    private $router = array
    (
        array ("news", "news/show_all_news"),
        array ("news/find/@text", "news/show_all_news_by_find_text"),
        array ("news/@subject", "news/show_all_news_by_subject"),
        array ("news/@subject/page/@page", "news/show_all_news_by_subject_on_page"),
        array ("news/@subject/@news", "news/show_one_news_by_subject_news"),
        array ("news/*", "news/show_error"),

        array ("shop", "shop/show_all_packets"),
        array ("shop/find/@text", "shop/show_all_packets_by_find_text"),
        array ("shop/rules", "shop/show_rules_of_shopping"),
        array ("shop/@packet", "shop/show_one_packet_by_id"),
        array ("shop/@packet/bill", "shop/show_one_packet_bill_form"),
        array ("shop/@packet/pay/@bill", "shop/show_one_packet_pay_form_by_bill"),
        array ("shop/@packet/start", "shop/show_one_packet_subscribe_form"),
        array ("shop/@packet/video", "shop/show_all_video_reports_for_packet"),
        array ("shop/@packet/reports", "shop/show_all_reports_for_packet"),
        array ("shop/@packet/reports/@lesson", "shop/show_all_reports_for_packet_lesson"),
        array ("shop/@packet/lessons", "shop/show_all_lessons_for_packet"),
        array ("shop/@packet/posts", "shop/show_all_posts_for_packet"),
        array ("shop/@packet/posts/@lesson", "shop/show_all_posts_for_packet_lesson"),
        array ("shop/@packet/@lesson", "shop/show_one_lesson_by_id_for_packet"),
        array ("shop/*", "shop/show_error"),

        array ("user", "user/show_all_users"),
        array ("user/online", "user/show_all_users_online"),
        array ("user/best", "user/show_all_users_are_best"),
        array ("user/best/week", "user/show_all_users_are_best_of_week"),
        array ("user/club", "user/show_all_users_in_club"),
        array ("user/@name", "user/show_one_user_by_name"),
        array ("user/@name/posts", "user/show_all_posts_of_user"),
        array ("user/@name/posts/on/@packet", "user/show_all_posts_of_user_by_packet"),
        array ("user/@name/posts/with/@friend", "user/show_all_posts_between_user_and_friend"),
        array ("user/@name/reports", "user/show_all_reports_of_user"),
        array ("user/@name/reports/on/@packet", "user/show_all_reports_of_user_by_packet"),
        array ("user/@name/video", "user/show_all_videos_of_user"),
        array ("user/*", "user/show_error"),

        array ("help", "help/show_help_about"),
        array ("help/ask", "help/show_ask_form"),
        array ("help/ask/@id", "help/show_all_answers_for_ask"),
        array ("help/faq", "help/show_all_faq"),
        array ("help/rules", "help/show_rules"),
        array ("help/contacts", "help/show_all_contacts"),
        array ("help/@topic", "help/show_all_articles_by_topic"),
        array ("help/@topic/@id", "help/show_one_article_by_topic_id"),
        array ("help/*", "help/show_error"),

        array ("me", "cabinet/show_user_info"),
        array ("me/join", "cabinet/show_join_form"),
        array ("me/login", "cabinet/show_login_form"),
        array ("me/login/password", "cabinet/show_change_password_form"),
        array ("me/edit", "cabinet/show_all_edits"),
        array ("me/edit/@section", "cabinet/show_all_options_by_section"),
        array ("me/stats", "cabinet/show_main_stats"),
        array ("me/posts", "cabinet/show_all_my_posts"),
        array ("me/packets", "cabinet/show_all_my_packets"),
        array ("me/payments", "cabinet/show_all_my_payments"),
        array ("me/payouts", "cabinet/show_all_my_payouts"),
        array ("me/refers", "cabinet/show_all_my_refers"),
        array ("me/*", "cabinet/show_error"),

        array ("*", "/news/show_error")
    );

    public function __construct()
    {
        $this->init_parts();
        $this->init_route();
    }

    private function init_parts ()
    {
        if (isset ($_GET [DATA_GET]))
            $this -> bars = explode ('/', trim($_GET [DATA_GET], '\\/'));
        else
            $this -> bars = array ();
    }

    private function init_route ()
    {
        $rule = $this->find_route();

        $path = explode("/", $rule [0]);
        $this->init_args($path);

        list ($this->class, $this->method) = explode("/", $rule [1]);
    }

    private function find_route ()
    {
        print_r ($this->bars);
        foreach ($this->router as $rule)
            if ($this->admit($rule[0]))
                return $rule;
        return array ();
    }

    private function init_args ($path)
    {
        $this->args = array ();
        for ($j = 0; $j < count($path); $j ++)
            if (substr($path [$j], 0, 1) == "@")
                $this->args [substr ($path[$j], 1)] = $this->bars [$j];
    }

    protected function admit ($route)
    {
        $route_items = explode ("/", trim($route, "/"));

        if (count($this->bars) != count ($route_items))
            return false;

//        echo "\ncmp " . $route;
        for ($j = 0; $j < count ($route_items); $j ++)
            if (!$this->like($route_items[$j], $this->bars[$j]))
                return false;

        return true;
    }

    protected function like ($item, $bar)
    {
        if ($item == $bar) return true;
        if (substr($item, 0, 1) == "@") return true;
        return false;
    }

    public function run ()
    {
        $this->error = "";
        if (!system\text::is_alpha($this->class))
            return $this->set_error ("incorrect symbols in class param");
        $class = "\\div\\" . $this->class;

        echo "<br> class/method: " . $class . " -> " . $this->method . " ()";
        echo "<br> Args: "; print_r ($this->args);
        return;

        try {
            $div = new $class ($this->bars);
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