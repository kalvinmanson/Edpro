<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Notification;
use Carbon\Carbon;

class NotificationController extends Controller
{
  public function index()
  {
    $notifications = Notification::orderBy('created_at', 'desc')->paginate(50);
    return view('admin.notifications.index', compact('notifications'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $filterFrom = new Carbon();
    $notifications = Notification::where('created_at', '<', $filterFrom->subMonth())->delete();
    flash('Records before '.$filterFrom.' were deleted.')->success();
    return redirect()->route('admin.notifications.index');
  }
}
