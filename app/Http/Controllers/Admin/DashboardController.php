<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
  /**
   * @var WidgetRepository
   */
  private $widget;
  /**
   * @var Authentication
   */
  private $auth;

  /**
   * @param Repository       $modules
   * @param WidgetRepository $widget
   * @param Authentication   $auth
   */
  public function __construct()
  {
  }

  /**
   * Display the dashboard with its widgets
   *
   * @return \Illuminate\View\View
   */
  public function index()
  {
    return view('admin.dashboard');
  }
}
