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
    parent::__construct();
  }

  /**
   * Display the dashboard with its widgets
   *
   * @return \Illuminate\View\View
   */
  public function index()
  {
    $this->requireAssets();
    return view('dashboard::admin.dashboard');
  }

  /**
   * Require necessary assets
   */
  private function requireAssets()
  {
    $this->assetPipeline->requireJs('lodash.js');
    $this->assetPipeline->requireJs('jquery-ui-core.js');
    $this->assetPipeline->requireJs('jquery-ui-widget.js');
    $this->assetPipeline->requireJs('jquery-ui-mouse.js');
    $this->assetPipeline->requireJs('jquery-ui-draggable.js');
    $this->assetPipeline->requireJs('jquery-ui-resizable.js');
    $this->assetPipeline->requireJs('gridstack.js');
    $this->assetPipeline->requireJs('chart.js');
    $this->assetPipeline->requireCss('gridstack.css')->before('asgard.css');
  }
}
