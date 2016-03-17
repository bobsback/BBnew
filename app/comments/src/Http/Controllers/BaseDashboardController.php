<?php

namespace Hazzard\Comments\Http\Controllers;

use Illuminate\Routing\Controller;

/**
 * Class BaseDashboardController
 *
 * @package Hazzard\Comments\Http\Controllers
 */
class BaseDashboardController extends Controller
{

    /**
     * Validate input for update.
     *
     * @param array $input
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateForUpdate(array $input)
    {
        $rules = [
            'status' => 'required|in:pending,approved,spam,trash',
            'content' => 'required|min:2',
            'author_url' => 'url|max:255',
            'author_name' => 'required|max:100',
            'author_email' => 'required|email|max:255',
        ];

        if ($max = config('comments.max_length')) {
            $rules['content'] .= "|max:$max";
        }

        return $this->getValidationFactory()->make($input, $rules);
    }

}
