<?php

namespace TreptowKolleg\Api\Task;

class Task
{

    private array $questions = [];

    /**
     * @param array $questions
     */
    public function __construct(array $questions = [])
    {
        $this->questions = $questions;
    }

    public function addQuestion(TaskQuestion $question)
    {
        $this->questions[] = $question;
    }

    public function render()
    {
        foreach ($this->questions as $key => $question) {
            $output =  '<section class="p-section">';
            $output .= '<div class="row">';
            $output .= '<div class="col">';
            $output .= '<h2 id="question_'.($key+1).'">Übung '.($key+1).'</h2>';
            $output .= '<form method="post" action="#question_'.($key+1).'" class="p-form p-form--stacked">';

        }
    }


}
