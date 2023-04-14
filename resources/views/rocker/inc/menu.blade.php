<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('img/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">{!! backpack_theme_config('project_logo') !!}</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ backpack_url('dashboard') }}">
                <div class="parent-icon"><i class="bx bx-category"></i></div>
                <div class="menu-title">{{ trans('backpack::base.dashboard') }}</div>
            </a>
        </li>

        @includeWhen(class_exists(\Backpack\DevTools\DevToolsServiceProvider::class), 'backpack.devtools::buttons.sidebar_item')

        <li class="menu-label">First-Party Addons</li>

        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-news"></i>
                </div>
                <div class="menu-title">News</div>
            </a>
            <ul>
                <li>
                    <a href="{{ backpack_url('article') }}">
                        <i class="bx bx-radio-circle"></i>Articles
                    </a>
                </li>
                <li>
                    <a href="{{ backpack_url('category') }}">
                        <i class="bx bx-radio-circle"></i>Categories
                    </a>
                </li>
                <li>
                    <a href="{{ backpack_url('tag') }}">
                        <i class="bx bx-radio-circle"></i>Tags
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="{{ backpack_url('page') }}">
                <div class="parent-icon"><i class="bx bx-file"></i></div>
                <div class="menu-title">Pages</div>
            </a>
        </li>

        <li>
            <a href="{{ backpack_url('menu-item') }}">
                <div class="parent-icon"><i class="bx bx-list-ul"></i></div>
                <div class="menu-title">Menu</div>
            </a>
        </li>

        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-group"></i>
                </div>
                <div class="menu-title">Authentication</div>
            </a>
            <ul>
                <li>
                    <a href="{{ backpack_url('user') }}">
                        <i class="bx bx-radio-circle"></i>Users
                    </a>
                </li>
                <li>
                    <a href="{{ backpack_url('role') }}">
                        <i class="bx bx-radio-circle"></i>Roles
                    </a>
                </li>
                <li>
                    <a href="{{ backpack_url('permission') }}">
                        <i class="bx bx-radio-circle"></i>Permissions
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-cog"></i>
                </div>
                <div class="menu-title">Advanced</div>
            </a>
            <ul>
                <li>
                    <a href="{{ backpack_url('elfinder') }}">
                        <i class="bx bx-radio-circle"></i>File
                    </a>
                </li>
                <li>
                    <a href="{{ backpack_url('backup') }}">
                        <i class="bx bx-radio-circle"></i>Backups
                    </a>
                </li>
                <li>
                    <a href="{{ backpack_url('log') }}">
                        <i class="bx bx-radio-circle"></i>Logs
                    </a>
                </li>
                <li>
                    <a href="{{ backpack_url('layout') }}">
                        <i class="bx bx-radio-circle"></i>Layouts
                    </a>
                </li>
                <li>
                    <a href="{{ backpack_url('setting') }}">
                        <i class="bx bx-radio-circle"></i>Settings
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-label">Example CRUDs</li>

        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="bx bxs-happy-beaming"></i>
                </div>
                <div class="menu-title">Monsters</div>
            </a>
            <ul>
                <li>
                    <a href="{{ backpack_url('monster') }}">
                        <i class="bx bx-radio-circle"></i>Monsters
                    </a>
                </li>
                <li>
                    <a href="{{ backpack_url('cave') }}">
                        <i class="bx bx-radio-circle"></i>Caves
                    </a>
                </li>
                <li>
                    <a href="{{ backpack_url('story') }}">
                        <i class="bx bx-radio-circle"></i>Stories <span class="badge badge-pill bg-warning text-dark ms-2">New</span>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="bx bxs-tired"></i>
                </div>
                <div class="menu-title">Other entities</div>
            </a>
            <ul>
                <li>
                    <a href="{{ backpack_url('icon') }}">
                        <i class="bx bx-radio-circle"></i>Icons
                    </a>
                </li>
                <li>
                    <a href="{{ backpack_url('product') }}">
                        <i class="bx bx-radio-circle"></i>Products
                    </a>
                </li>
                <li>
                    <a href="{{ backpack_url('fluent-monster') }}">
                        <i class="bx bx-radio-circle"></i>Fluent Monsters
                    </a>
                </li>
                <li>
                    <a href="{{ backpack_url('field-monster') }}">
                        <i class="bx bx-radio-circle"></i>Field Monsters
                    </a>
                </li>
                <li>
                    <a href="{{ backpack_url('editable-monster') }}">
                        <i class="bx bx-radio-circle"></i>Editable Monsters
                    </a>
                </li>
                <li>
                    <a href="{{ backpack_url('dummy') }}">
                        <i class="bx bx-radio-circle"></i>Dummies
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="bx bxs-bug"></i>
                </div>
                <div class="menu-title">
                    Pet Shop <span class="badge text-light badge-pill bg-warning">New</span>
                </div>
            </a>
            <ul>
                <li>
                    <a href="{{ backpack_url('pet-shop/about') }}">
                        <i class="bx bx-radio-circle"></i>About
                    </a>
                </li>
                <li>
                    <a href="{{ backpack_url('pet-shop/invoice') }}">
                        <i class="bx bx-radio-circle"></i>Invoices
                    </a>
                </li>
                <li>
                    <a href="{{ backpack_url('pet-shop/owner') }}">
                        <i class="bx bx-radio-circle"></i>Owners
                    </a>
                </li>
                <li>
                    <a href="{{ backpack_url('pet-shop/pet') }}">
                        <i class="bx bx-radio-circle"></i>Badges
                    </a>
                </li>
                <li>
                    <a href="{{ backpack_url('pet-shop/skill') }}">
                        <i class="bx bx-radio-circle"></i>Skills
                    </a>
                </li>
                <li>
                    <a href="{{ backpack_url('pet-shop/comment') }}">
                        <i class="bx bx-radio-circle"></i>Comments
                    </a>
                </li>
            </ul>
        </li>

    </ul>
    <!--end navigation-->
</div>