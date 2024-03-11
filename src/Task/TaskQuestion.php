<?php

namespace TreptowKolleg\Api\Task;

class TaskQuestion
{

    private string $question;

    private string $answer;

    /**
     * @param string $question
     * @param string $answer
     */
    public function __construct(string $question, string $answer)
    {
        $this->question = $question;
        $this->answer = $answer;
    }

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->answer;
    }


}