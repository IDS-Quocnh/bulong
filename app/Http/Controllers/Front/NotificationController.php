<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bulong\Categories\Repositories\Interfaces\CategoryRepositoryInterface;

class NotificationController extends Controller
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepo;

    /**
     * HomeController constructor.
     *
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->categoryRepo = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepo->listCategories('created_at', 'desc');

        if (request()->ajax()) {
            return auth()->user()->notifications;
        }

        return view('front.users.notifications', compact('categories'));

        // return view('front.notifications.index', compact('categories'));
    }

    public function markAllAsRead()
    {
        $user = auth()->user();

        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }

        return redirect()->back();
    }
}
