<?php

use App\Admin\Actions\CustomActions as ActionsCustomActions;
use App\Admin\Custom\CustomActions;
use App\Admin\Custom\CustomDateTime;
use App\Admin\Custom\CustomModals\ImageModal;
use Encore\Admin\Admin;
use Encore\Admin\Table\Column;

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */
// Form::extend('colorpicker', App\Admin\Forms\Colors\ColorPickerField::class);

Column::extend('editButton', CustomActions::class);
Column::extend('editButton2', ActionsCustomActions::class);
Column::extend('imageModal', ImageModal::class);
Column::extend('formatDate', CustomDateTime::class);
Column::extend('cusAct', ActionsCustomActions::class);
// Column::define('__actions__', ActionsCustomActions::class);
Admin::script("
        if (!document.querySelector('#my_color_picker')) {
                console.log('The element does not exist.');
                var inputElement = $('#clr-picker');
                inputElement.remove();
            }
");
// Admin::style('
//             .content-wrapper {
//                 background: #f8f9fa;
//             }
//             [class*=sidebar-light] .brand-link, nav.main-header{
//                 height: 70px;
//             }
//             nav.main-header, .main-sidebar{
//                 background-color: #6c5ecf;
//                 // background-color: #6f42c1;
//             }
//             .nav-link i, .nav-link p{
//                 color: white;
//             }
//             .navbar-light, .brand-text {
//                 background-color: #38abbe;
//                 color: white;
//                 font-weight: 700;
//             }
            
//             a.brand-link.navbar-light {
//                 display: flex;
//                 align-items: center;
//             }
//             .brand-link .brand-image{
//                 background-color: #ffffff;
//                 // background-color: #f8f9fa;
//                 border-radius: 100%;
//             }
//             .font-weight-bolder {
//                 font-weight: bolder!important;
//             }
//             .fa-filter:before, .fa-download:before, .fa-table:before {
//                 color: #38abbe;
//             }
//             .card-info.card-outline{
//                 border-top-color: #6c5ecf;
//             }
//             .fa-clone:before, .text-sm  .fa-sort:before{
//                 color: #38abbe;
//             }
//             .accent-info a:not(.dropdown-item):not(.btn-app):not(.nav-link):not(.brand-link):not(.page-link):not(.btn) {
//                 color: #0f0f0f;
//             }
//             .accent-info [class*=sidebar-light-] .sidebar a:not(.dropdown-item):not(.btn-app):not(.nav-link):not(.brand-link) {
//                 color: #ffffff;
//             }
//             .table.table-head-fixed thead tr:nth-child(1) th {
//                 background-color: #3d5d7e;
//                 // background-color: #343a40;
//                 // opacity: 0.8;
//                 border-right: 0;
//                 font-weight: 500;
//                 color: white;
//                 text-wrap: nowrap;
//             }
//             .fa-ellipsis-v:before {
//                 color: #ea4848;
//                 // color: #ffa500;
//             }
            
//             .accent-info .page-item.disabled .page-link{
//                 color: #ea4848;
//                 font-size: 15px;
//             }
//             tr::hover {
//                 background-color: #343a40;
//             }
//             .card-content{
//                 text-align:left;
//             }
//         ');
