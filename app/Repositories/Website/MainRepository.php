<?php

namespace App\Repositories\Website;

use App\Models\Blog;
use App\Models\Career;
use App\Models\CareerApplication;
use App\Models\ContactMessage;
use App\Models\Page;

class MainRepository
{
    public function getActivePagesList()
    {
        return Page::with([
            'media',
            'sections' => function ($q) {
                $q->where('is_active', 1)
                ->with([
                    'items' => function ($q) {
                        $q->where('is_active', 1)
                            ->with('media');
                    },
                    'media'
                ]);
            }
        ])
        ->where('is_active', 1)
        ->get();
    }

    public function getPublishedBlogsList()
    {
        return Blog::with(['media', 'user'])->where('is_published', 1)->get();
    }

    public function getActiveCareersList()
    {
        return Career::where('is_active', 1)
            ->where('deadline', '>=', now())
            ->get();
    }

    public function ApplyJobApplication(array $application_request)
    {
        return CareerApplication::create($application_request);
    }

    public function ContactUs(array $message_request)
    {
        return ContactMessage::create($message_request);
    }




}
