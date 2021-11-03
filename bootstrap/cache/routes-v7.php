<?php

/*
|--------------------------------------------------------------------------
| Load The Cached Routes
|--------------------------------------------------------------------------
|
| Here we will decode and unserialize the RouteCollection instance that
| holds all of the route information for an application. This allows
| us to instantaneously load the entire route map into the router.
|
*/

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/coinpayment/make' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'coinpayment.make.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/coinpayment/ajax/payload' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'coinpayment.encrypt.payload',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/coinpayment/ajax/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'coinpayment.create.transaction',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/coinpayment/ipn' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'coinpayment.ipn',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/blog' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/blog/search' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.search',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/blog/feed' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.feed',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/blog_admin' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.admin.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/blog_admin/add_post' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.admin.create_post',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.admin.store_post',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/blog_admin/image_uploads' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.admin.images.all',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/blog_admin/image_uploads/upload' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.admin.images.upload',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.admin.images.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/blog_admin/comments' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.admin.comments.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/blog_admin/categories' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.admin.categories.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/blog_admin/categories/add_category' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.admin.categories.create_category',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.admin.categories.store_category',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::HLfvRiAaE3HZj3CJ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::gi8L7xXrGgCOgeX3',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/stats' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::HY7DROF8MrOZO5IZ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/me' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::I6PvZKMjyv3fVkwa',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/me/details' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mm4yvFp84BNGHkUI',
          ),
          1 => NULL,
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/me/details/auth' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::A4Bk4MwsjsVyV5VY',
          ),
          1 => NULL,
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/me/avatar' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9HcgoP8H49xEsLTt',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::EP7wERizl2rr2ff9',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/me/avatar/external' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fOsKJpChU95oOFyI',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/me/sessions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::o3n28hPCD570wogb',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/me/return' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::LDU813OLJsUBxah8',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/games' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kR9qxws0NM6Op1ID',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/category' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::SgHLGELZmGmHjSOp',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/jackpots' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7LjE2tHpGVYbCSUB',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/transactions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::K2SgFod3Nd24HN3G',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/stats/pay' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fP5IUOpPawL6gtOU',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/stats/game' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::LYjqtLxjTnwWPb46',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/stats/bank' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OYeNlBDBA2HOALmA',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/stats/shop' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZLIrNupdQjZqmv6w',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/stats/shift' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::y7yXhoMi4EsKRNd1',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/shifts/start' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PmrjemFekmNoH1jQ',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/shifts/info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::dbyQjgn45telzcRO',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/shops/currency' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::X8qnHYPgWTHU0MMX',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/shops/block' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VHlrx3X5zpfHsb6z',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/shops/unblock' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::obuFZu67VvaVksGH',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/shops/get' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2z99gyeGRaFycyEo',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/users' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'users.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'users.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/activity' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::AaOqvaMYNGtgFOZc',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/settings' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TOXeSQFsxBWBUZnh',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/apigame_balance' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Z0MnYOLbtA1s2Vm7',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.auth.login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.auth.login.post',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.auth.logout',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ip' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.auth.ip',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/usernameCheck' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.auth.usernameCheck',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/emailCheck' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.auth.emailCheck',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.register',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.register.post',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/register2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.register2.post',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/register/page' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.register.postpage',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/check_freespin100' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.check_freespin100',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/forgotpassword' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.forgotpassword',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/reset' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.password.reset.post',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/support/ticket' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.support.ticket',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/deposit/payment' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.deposit.payment',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cashout/payment' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.cashout.payment',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/withdraw/payment' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.withdraw.payment',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/payment/gigadat/success' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3vr4XlbmvQfShyo9',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/payment/gigadat/failure' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::S8XJ7ncg9WYNRwd0',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/payment/gigadat/listener' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::zvv8D5wr0DXrpG65',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/about' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0kNjDPRLZUBKdp5i',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/bonus' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::iGTQvj44TnZEihRl',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/bonus/term' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::InwbIyninrFauZru',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/promotions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BHJoCn1aAfJuFaPL',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cryptocurrencies_list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.cryptopayment.cryptocurrencies_list',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/check_freemodal' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.check_freemodal',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/check_email' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.check_email',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/callback_cryptopayment' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.games.callback_cryptopayment',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/subsession' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.subsession',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.info',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/history/payment' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.history.payment',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/history/bet' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.history.bet',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/bonus' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.bonus',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/freespin' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.freespin',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/activity' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.activity',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/balance' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.balance',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.balance.post',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/balance/success' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.balance.success',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/balance/fail' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.balance.fail',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/details/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.update.details',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/password/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.update.password',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/avatar/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.update.avatar',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/avatar/update/external' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.update.avatar-external',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/exchange' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.exchange',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/login-details/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.update.login-details',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/two-factor/enable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.two-factor.enable',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/two-factor/disable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.two-factor.disable',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/sessions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.sessions',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/returns' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.returns',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/jackpots' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.jackpots',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/pincode' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.pincode',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/verify' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.verify',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/verify/submit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.password',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/detail' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.detail',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/transaction' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.transaction',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/deposit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.deposit',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/withdraw' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.withdraw',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.game.list',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/search' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.game.search',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.search.game',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/setpage.json' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.category.setpage',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/game_init' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.game.init',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/game_stat' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.game_stat',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ajax/loadmore/game' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.loadmore.game',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/callback_gamehub' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.games.callback_gamehub',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/canada777-up-to-100-free-spin' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.promotions.up_to_100_free_spin',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/phone_verify' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'phone_verify',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/phone_verify2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.phone_verify2.post',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/canada777-up-to-100-free-spin-phone-confirm' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.promotions.up_to_100_free_spin_phone_confirm',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/phone_confirm' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'phone_confirm',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/canada777-welcome-up-to-100-free-spin' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.promotions.welcome_promotion_up_to_100_free_spin',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/canada777-up-to-100-free-spin2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.promotions.up_to_100_free_spin2',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/canada777-up-to-100-free-spin-phone-confirm2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.promotions.up_to_100_free_spin_phone_confirm2',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/canada777-welcome-up-to-100-free-spin2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.promotions.welcome_promotion_up_to_100_free_spin2',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.auth.login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'backend.auth.login.post',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.auth.logout',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/search' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.search',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/game_stat' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.game_stat',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/game_stat/clear' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.game_stat.clear',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/bank_stat' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.bank_stat',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/shop_stat' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.shop_stat',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/shift_stat' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.shift_stat',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/live' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.live_stat',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/start_shift' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.start_shift',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/country' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.country',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/currency' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.currency',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/withdraw' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.withdraw.list',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/profile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.profile',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/profile/activity' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.profile.activity',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/profile/details/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.profile.update.details',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/profile/avatar/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.profile.update.avatar',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/profile/avatar/update/external' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.profile.update.avatar-external',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/profile/login-details/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.profile.update.login-details',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/profile/two-factor/enable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.profile.two-factor.enable',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/profile/two-factor/disable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.profile.two-factor.disable',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/profile/sessions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.profile.sessions',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/profile/setshop' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.profile.setshop',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.user.list',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/tree' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.user.tree',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/statistics' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.statistics',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/profile/balance/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.user.balance.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/profile/balance/update/manually' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.user.balance.update.manually',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/user/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.user.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'backend.user.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/user/mass' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.user.massadd',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/notifications' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.notifications.list',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/notifications/add' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.notifications.add',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/automizy/create_list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.automizy.create_list',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/automizy/list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.automizy.list',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/automizy/add_list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.automizy.add_list',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/game' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.game.list',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/games.json' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.game.list.json',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/game/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.game.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'backend.game.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/game/update/mass' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.game.mass',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/gamebanks_add' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.game.gamebanks_add',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/gamebanks_clear' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.game.gamebanks_clear',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/bonus' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.bonus.list',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/bonus/add' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.bonus.add',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/freespinround' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.freespinround.list',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/freespinround/add' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.freespinround.add',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/freeplay' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.freeplay.list',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/category' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.category.list',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/category/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.category.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'backend.category.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/shops' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.shop.list',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/shops/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.shop.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'backend.shop.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/shops/admin/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.shop.admin_create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'backend.shop.admin_store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/shops/balance' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.shop.balance',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/pincodes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.pincode.list',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/pincodes/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.pincode.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'backend.pincode.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/pincodes/mass/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.pincode.massadd',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/pincodes/balance' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.pincode.balance',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/happyhours' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.happyhour.list',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/happyhours/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.happyhour.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'backend.happyhour.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.info.list',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/info/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.info.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'backend.info.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/info/balance' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.info.balance',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/api' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.api.list',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/api/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.api.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'backend.api.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/api/generate' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.api.generate',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/api/json' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.api.json',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/api/balance' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.api.balance',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/returns' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.returns.list',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/returns/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.returns.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'backend.returns.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/jpgame' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.jpgame.list',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/jpgame/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.jpgame.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'backend.jpgame.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/jpgame/balance' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.jpgame.balance',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/role' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.role.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/role/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.role.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/role/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.role.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/permission/save' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.permission.save',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/permission' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.permission.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/permission/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.permission.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/permission/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.permission.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/settings' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.settings.general',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/settings/general' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.settings.general.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/settings/auth' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.settings.auth',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'backend.settings.auth.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/generator' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.settings.generator',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'backend.settings.generator.post',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/shops/block' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.settings.shop_block',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/shops/unblock' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.settings.shop_unblock',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/settings/sync' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.settings.sync',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/activity' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.activity.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/backend/activity/clear' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.activity.clear',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/coinpayment/(?|make/([^/]++)(*:36)|ajax/rates/([^/]++)(*:62))|/blog(?|/(?|category/([^/]++)(*:99)|([^/]++)(*:114)|save_comment/([^/]++)(*:143))|_admin/(?|edit_post/([^/]++)(?|(*:183))|image_uploads/post/([^/]++)/delete\\-images(?|(*:237))|delete_post/([^/]++)(*:266)|c(?|omments/([^/]++)(?|(*:297))|ategories/(?|edit_category/([^/]++)(?|(*:344))|delete_category/([^/]++)(*:377)))))|/api/(?|game(?|s/([^/]++)(*:414)|/([^/]++)/server(*:438))|s(?|hops/balance/([^/]++)(*:472)|essions/([^/]++)(?|(*:499)))|users/([^/]++)(?|(*:526)|/(?|edit(*:542)|a(?|vatar(?|(*:562)|/external(*:579)|(*:587))|ctivity(*:603))|sessions(*:620)|balance/([^/]++)(*:644))|(*:653)))|/((?:home|alberta|british-columbia|manitoba|new-brunswick|northwest-territories|nova-scotia|ontario|prince-edward-island|saskatchewan|quebec|vegascasinoonline|casinoniagarafalls|betway|888casino))(*:859)|/launcher/([^/]++)/([^/]++)/([^/]++)(*:903)|/register/confirmation/([^/]++)(*:942)|/p(?|assword/reset/([^/]++)(*:977)|rofile/sessions/([^/]++)/invalidate(*:1020))|/setlang/([^/]++)(*:1047)|/categories/([^/]++)(?|(*:1079)|/([^/]++)(*:1097))|/game/([^/]++)/(?|([^/]++)(*:1133)|server(*:1148))|/apigame/([^/]++)/([^/]++)(*:1184)|/backend/(?|withdraw/(?|approve/([^/]++)(*:1233)|reject/([^/]++)(*:1257))|c(?|rypto_withdraw/(?|approve/([^/]++)(*:1305)|reject/([^/]++)(*:1329))|ategory/([^/]++)/(?|edit(*:1363)|update(*:1378)|delete(*:1393)))|p(?|rofile/sessions/([^/]++)/invalidate(*:1443)|incodes/([^/]++)/(?|edit(*:1476)|update(*:1491)|delete(*:1506))|ermission/([^/]++)/(?|edit(*:1542)|update(*:1557)|delete(*:1572)))|user/(?|([^/]++)/(?|s(?|tat(*:1610)|how(*:1622)|essions(?|(*:1641)|/([^/]++)/invalidate(*:1670)))|profile(*:1688)|update/(?|de(?|tails(*:1717)|posit\\-amount(*:1739))|verify(*:1755)|login\\-details(*:1778)|avatar(?|(*:1796)|/external(*:1814)))|delete(*:1831)|hard_delete(*:1851)|two\\-factor/(?|enable(*:1881)|disable(*:1897)))|action/([^/]++)(*:1923))|notifications/(?|edit/([^/]++)(*:1963)|delete/([^/]++)(*:1987))|a(?|utomizy/(?|edit_list/([^/]++)(*:2030)|delete_list/([^/]++)(*:2059)|add_contacts/([^/]++)/([^/]++)(*:2098))|pi/([^/]++)/(?|edit(*:2127)|update(*:2142)|delete(*:2157))|ctivity/user/([^/]++)/log(*:2192))|game/(?|([^/]++)(?|/(?|s(?|how(*:2232)|erver(*:2246))|edit(*:2260)|api(?|edit(*:2279)|update(*:2294))|update(*:2310)|delete(*:2325))|(*:2335))|categories(*:2355)|orderupdate(*:2375))|bonus/(?|edit/([^/]++)(*:2407)|delete/([^/]++)(*:2431))|freespinround/(?|edit/([^/]++)(*:2471)|delete/([^/]++)(*:2495))|shops/([^/]++)/(?|edit(*:2527)|update(*:2542)|delete(*:2557)|hard_delete(*:2577)|action/([^/]++)(*:2601))|happyhours/([^/]++)/(?|edit(*:2638)|update(*:2653)|delete(*:2668))|info/([^/]++)/(?|edit(*:2699)|update(*:2714)|delete(*:2729))|r(?|eturns/([^/]++)/(?|edit(*:2766)|update(*:2781)|delete(*:2796))|ole/([^/]++)/(?|edit(*:2826)|update(*:2841)|delete(*:2856)))|jpgame/([^/]++)/(?|edit(*:2890)|update(*:2905))))/?$}sDu',
    ),
    3 => 
    array (
      36 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'coinpayment.make.show',
          ),
          1 => 
          array (
            0 => 'make',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      62 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'coinpayment.rates',
          ),
          1 => 
          array (
            0 => 'usd',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      99 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.view_category',
          ),
          1 => 
          array (
            0 => 'categorySlug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      114 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.single',
          ),
          1 => 
          array (
            0 => 'blogPostSlug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      143 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.comments.add_new_comment',
          ),
          1 => 
          array (
            0 => 'blogPostSlug',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      183 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.admin.edit_post',
          ),
          1 => 
          array (
            0 => 'blogPostId',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.admin.update_post',
          ),
          1 => 
          array (
            0 => 'blogPostId',
          ),
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      237 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.admin.images.delete-post-image',
          ),
          1 => 
          array (
            0 => 'postId',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.admin.images.delete-post-image-confirmed',
          ),
          1 => 
          array (
            0 => 'postId',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      266 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.admin.destroy_post',
          ),
          1 => 
          array (
            0 => 'blogPostId',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      297 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.admin.comments.approve',
          ),
          1 => 
          array (
            0 => 'commentId',
          ),
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.admin.comments.delete',
          ),
          1 => 
          array (
            0 => 'commentId',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      344 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.admin.categories.edit_category',
          ),
          1 => 
          array (
            0 => 'categoryId',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.admin.categories.update_category',
          ),
          1 => 
          array (
            0 => 'categoryId',
          ),
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      377 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogetc.admin.categories.destroy_category',
          ),
          1 => 
          array (
            0 => 'categoryId',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      414 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hMOxKg7xzhI1ADUw',
          ),
          1 => 
          array (
            0 => 'game',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      438 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ddLOykYAq9d56mMf',
          ),
          1 => 
          array (
            0 => 'game',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      472 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qygRF0oOZvIvI2rb',
          ),
          1 => 
          array (
            0 => 'type',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      499 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::eMnTt9nRrAamS5zj',
          ),
          1 => 
          array (
            0 => 'session',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::4unjtqH3S8Y7gQxb',
          ),
          1 => 
          array (
            0 => 'session',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      526 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'users.show',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      542 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'users.edit',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      562 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YXFMCIHjzzedTuYL',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      579 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::k1R7RpKOG9Y4IweV',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      587 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::wDw2fIlF1G9Nnhgg',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      603 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::4k6JzEuVq4NIuroU',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      620 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Z910J2uHTOMUr9Li',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      644 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ELrl97XE5RXuHhhr',
          ),
          1 => 
          array (
            0 => 'user',
            1 => 'type',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      653 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'users.update',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'users.destroy',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      859 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OvpuHSqM5M2p8bEG',
          ),
          1 => 
          array (
            0 => 'url',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      903 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Pjup8fOZ3sp8X5dZ',
          ),
          1 => 
          array (
            0 => 'game',
            1 => 'token',
            2 => 'mode',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      942 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.register.confirm-email',
          ),
          1 => 
          array (
            0 => 'token',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      977 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.password.reset',
          ),
          1 => 
          array (
            0 => 'token',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1020 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.profile.sessions.invalidate',
          ),
          1 => 
          array (
            0 => 'session',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1047 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.setlang',
          ),
          1 => 
          array (
            0 => 'lang',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1079 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.game.list.category',
          ),
          1 => 
          array (
            0 => 'category1',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1097 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.game.list.category_level2',
          ),
          1 => 
          array (
            0 => 'category1',
            1 => 'category2',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1133 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.game.go.prego',
          ),
          1 => 
          array (
            0 => 'game',
            1 => 'prego',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1148 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.game.server',
          ),
          1 => 
          array (
            0 => 'game',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1184 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'frontend.game.apigame',
          ),
          1 => 
          array (
            0 => 'game',
            1 => 'type',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1233 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.withdraw.approve',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1257 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.withdraw.reject',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1305 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.crypto_withdraw.approve',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1329 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.crypto_withdraw.reject',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1363 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.category.edit',
          ),
          1 => 
          array (
            0 => 'category',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1378 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.category.update',
          ),
          1 => 
          array (
            0 => 'category',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1393 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.category.delete',
          ),
          1 => 
          array (
            0 => 'category',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1443 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.profile.sessions.invalidate',
          ),
          1 => 
          array (
            0 => 'session',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1476 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.pincode.edit',
          ),
          1 => 
          array (
            0 => 'pincode',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1491 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.pincode.update',
          ),
          1 => 
          array (
            0 => 'pincode',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1506 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.pincode.delete',
          ),
          1 => 
          array (
            0 => 'pincode',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1542 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.permission.edit',
          ),
          1 => 
          array (
            0 => 'permission',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1557 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.permission.update',
          ),
          1 => 
          array (
            0 => 'permission',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1572 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.permission.delete',
          ),
          1 => 
          array (
            0 => 'permission',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1610 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.user.stat',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1622 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.user.show',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1641 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.user.sessions',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1670 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.user.sessions.invalidate',
          ),
          1 => 
          array (
            0 => 'user',
            1 => 'session',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1688 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.user.edit',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1717 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.user.update.details',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1739 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.user.update.deposit-amount',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1755 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.user.update.verify',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1778 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.user.update.login-details',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1796 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.user.update.avatar',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1814 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.user.update.avatar.external',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1831 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.user.delete',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1851 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.user.hard_delete',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1881 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.user.two-factor.enable',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1897 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.user.two-factor.disable',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1923 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.user.action',
          ),
          1 => 
          array (
            0 => 'action',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1963 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.notifications.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1987 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.notifications.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2030 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.automizy.edit_list',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2059 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.automizy.delete_list',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2098 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.automizy.add_contacts',
          ),
          1 => 
          array (
            0 => 'id',
            1 => 'email',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2127 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.api.edit',
          ),
          1 => 
          array (
            0 => 'api',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2142 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.api.update',
          ),
          1 => 
          array (
            0 => 'api',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2157 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.api.delete',
          ),
          1 => 
          array (
            0 => 'api',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2192 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.activity.user',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2232 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.game.show',
          ),
          1 => 
          array (
            0 => 'game',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2246 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.game.server',
          ),
          1 => 
          array (
            0 => 'game',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2260 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.game.edit',
          ),
          1 => 
          array (
            0 => 'game',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2279 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.game.apiedit',
          ),
          1 => 
          array (
            0 => 'apigame',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2294 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.game.apiupdate',
          ),
          1 => 
          array (
            0 => 'apigame',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2310 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.game.update',
          ),
          1 => 
          array (
            0 => 'game',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2325 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.game.delete',
          ),
          1 => 
          array (
            0 => 'game',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2335 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.game.go',
          ),
          1 => 
          array (
            0 => 'game',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2355 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.game.categories',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2375 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.game.orderupdate',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2407 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.bonus.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2431 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.bonus.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2471 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.freespinround.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2495 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.freespinround.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2527 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.shop.edit',
          ),
          1 => 
          array (
            0 => 'shop',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2542 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.shop.update',
          ),
          1 => 
          array (
            0 => 'shop',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2557 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.shop.delete',
          ),
          1 => 
          array (
            0 => 'shop',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2577 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.shop.hard_delete',
          ),
          1 => 
          array (
            0 => 'shop',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2601 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.shop.action',
          ),
          1 => 
          array (
            0 => 'shop',
            1 => 'action',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2638 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.happyhour.edit',
          ),
          1 => 
          array (
            0 => 'happyhour',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2653 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.happyhour.update',
          ),
          1 => 
          array (
            0 => 'happyhour',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2668 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.happyhour.delete',
          ),
          1 => 
          array (
            0 => 'happyhour',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2699 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.info.edit',
          ),
          1 => 
          array (
            0 => 'info',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2714 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.info.update',
          ),
          1 => 
          array (
            0 => 'info',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2729 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.info.delete',
          ),
          1 => 
          array (
            0 => 'info',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2766 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.returns.edit',
          ),
          1 => 
          array (
            0 => 'return',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2781 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.returns.update',
          ),
          1 => 
          array (
            0 => 'return',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2796 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.returns.delete',
          ),
          1 => 
          array (
            0 => 'return',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2826 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.role.edit',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2841 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.role.update',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2856 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.role.delete',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2890 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.jpgame.edit',
          ),
          1 => 
          array (
            0 => 'jackpot',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2905 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'backend.jpgame.update',
          ),
          1 => 
          array (
            0 => 'jackpot',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'coinpayment.make.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'coinpayment/make',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'coinpayment.make.store',
        'uses' => 'Hexters\\CoinPayment\\Http\\Controllers\\MakeTransactionController@store',
        'controller' => 'Hexters\\CoinPayment\\Http\\Controllers\\MakeTransactionController@store',
        'namespace' => 'Hexters\\CoinPayment\\Http\\Controllers',
        'prefix' => 'coinpayment/',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'coinpayment.make.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'coinpayment/make/{make}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'coinpayment.make.show',
        'uses' => 'Hexters\\CoinPayment\\Http\\Controllers\\MakeTransactionController@show',
        'controller' => 'Hexters\\CoinPayment\\Http\\Controllers\\MakeTransactionController@show',
        'namespace' => 'Hexters\\CoinPayment\\Http\\Controllers',
        'prefix' => 'coinpayment/',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'coinpayment.rates' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'coinpayment/ajax/rates/{usd}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Hexters\\CoinPayment\\Http\\Controllers\\AjaxController@rates',
        'controller' => 'Hexters\\CoinPayment\\Http\\Controllers\\AjaxController@rates',
        'as' => 'coinpayment.rates',
        'namespace' => 'Hexters\\CoinPayment\\Http\\Controllers',
        'prefix' => 'coinpayment/ajax',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'coinpayment.encrypt.payload' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'coinpayment/ajax/payload',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Hexters\\CoinPayment\\Http\\Controllers\\AjaxController@encrypt_payload',
        'controller' => 'Hexters\\CoinPayment\\Http\\Controllers\\AjaxController@encrypt_payload',
        'as' => 'coinpayment.encrypt.payload',
        'namespace' => 'Hexters\\CoinPayment\\Http\\Controllers',
        'prefix' => 'coinpayment/ajax',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'coinpayment.create.transaction' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'coinpayment/ajax/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Hexters\\CoinPayment\\Http\\Controllers\\AjaxController@create_transaction',
        'controller' => 'Hexters\\CoinPayment\\Http\\Controllers\\AjaxController@create_transaction',
        'as' => 'coinpayment.create.transaction',
        'namespace' => 'Hexters\\CoinPayment\\Http\\Controllers',
        'prefix' => 'coinpayment/ajax',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'coinpayment.ipn' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'coinpayment/ipn',
      'action' => 
      array (
        'uses' => 'Hexters\\CoinPayment\\Http\\Controllers\\IPNController@__invoke',
        'controller' => 'Hexters\\CoinPayment\\Http\\Controllers\\IPNController',
        'as' => 'coinpayment.ipn',
        'namespace' => 'Hexters\\CoinPayment\\Http\\Controllers',
        'prefix' => '/coinpayment',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'blog',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\PostsController@index',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\PostsController@index',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => '/blog',
        'where' => 
        array (
        ),
        'as' => 'blogetc.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.search' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'blog/search',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\PostsController@search',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\PostsController@search',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => '/blog',
        'where' => 
        array (
        ),
        'as' => 'blogetc.search',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.feed' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'blog/feed',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\BlogEtcRssFeedController@feed',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\BlogEtcRssFeedController@feed',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => '/blog',
        'where' => 
        array (
        ),
        'as' => 'blogetc.feed',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.view_category' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'blog/category/{categorySlug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\PostsController@showCategory',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\PostsController@showCategory',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => '/blog',
        'where' => 
        array (
        ),
        'as' => 'blogetc.view_category',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.single' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'blog/{blogPostSlug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\PostsController@show',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\PostsController@show',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => '/blog',
        'where' => 
        array (
        ),
        'as' => 'blogetc.single',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.comments.add_new_comment' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'blog/save_comment/{blogPostSlug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'throttle:10,3',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\CommentsController@store',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\CommentsController@store',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => '/blog',
        'where' => 
        array (
        ),
        'as' => 'blogetc.comments.add_new_comment',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.admin.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'blog_admin',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManagePostsController@index',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManagePostsController@index',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => '/blog_admin',
        'where' => 
        array (
        ),
        'as' => 'blogetc.admin.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.admin.create_post' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'blog_admin/add_post',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManagePostsController@create',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManagePostsController@create',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => '/blog_admin',
        'where' => 
        array (
        ),
        'as' => 'blogetc.admin.create_post',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.admin.store_post' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'blog_admin/add_post',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManagePostsController@store',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManagePostsController@store',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => '/blog_admin',
        'where' => 
        array (
        ),
        'as' => 'blogetc.admin.store_post',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.admin.edit_post' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'blog_admin/edit_post/{blogPostId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManagePostsController@edit',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManagePostsController@edit',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => '/blog_admin',
        'where' => 
        array (
        ),
        'as' => 'blogetc.admin.edit_post',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.admin.update_post' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'blog_admin/edit_post/{blogPostId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManagePostsController@update',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManagePostsController@update',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => '/blog_admin',
        'where' => 
        array (
        ),
        'as' => 'blogetc.admin.update_post',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.admin.images.all' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'blog_admin/image_uploads',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageUploadsController@index',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageUploadsController@index',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => 'blog_admin/image_uploads',
        'where' => 
        array (
        ),
        'as' => 'blogetc.admin.images.all',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.admin.images.upload' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'blog_admin/image_uploads/upload',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageUploadsController@create',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageUploadsController@create',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => 'blog_admin/image_uploads',
        'where' => 
        array (
        ),
        'as' => 'blogetc.admin.images.upload',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.admin.images.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'blog_admin/image_uploads/upload',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageUploadsController@store',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageUploadsController@store',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => 'blog_admin/image_uploads',
        'where' => 
        array (
        ),
        'as' => 'blogetc.admin.images.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.admin.images.delete-post-image' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'blog_admin/image_uploads/post/{postId}/delete-images',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageUploadsController@deletePostImage',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageUploadsController@deletePostImage',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => 'blog_admin/image_uploads',
        'where' => 
        array (
        ),
        'as' => 'blogetc.admin.images.delete-post-image',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.admin.images.delete-post-image-confirmed' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'blog_admin/image_uploads/post/{postId}/delete-images',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageUploadsController@deletePostImageConfirmed',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageUploadsController@deletePostImageConfirmed',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => 'blog_admin/image_uploads',
        'where' => 
        array (
        ),
        'as' => 'blogetc.admin.images.delete-post-image-confirmed',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.admin.destroy_post' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'blog_admin/delete_post/{blogPostId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManagePostsController@destroy',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManagePostsController@destroy',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => '/blog_admin',
        'where' => 
        array (
        ),
        'as' => 'blogetc.admin.destroy_post',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.admin.comments.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'blog_admin/comments',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageCommentsController@index',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageCommentsController@index',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => 'blog_admin/comments',
        'where' => 
        array (
        ),
        'as' => 'blogetc.admin.comments.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.admin.comments.approve' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'blog_admin/comments/{commentId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageCommentsController@approve',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageCommentsController@approve',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => 'blog_admin/comments',
        'where' => 
        array (
        ),
        'as' => 'blogetc.admin.comments.approve',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.admin.comments.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'blog_admin/comments/{commentId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageCommentsController@destroy',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageCommentsController@destroy',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => 'blog_admin/comments',
        'where' => 
        array (
        ),
        'as' => 'blogetc.admin.comments.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.admin.categories.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'blog_admin/categories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageCategoriesController@index',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageCategoriesController@index',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => 'blog_admin/categories',
        'where' => 
        array (
        ),
        'as' => 'blogetc.admin.categories.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.admin.categories.create_category' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'blog_admin/categories/add_category',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageCategoriesController@create',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageCategoriesController@create',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => 'blog_admin/categories',
        'where' => 
        array (
        ),
        'as' => 'blogetc.admin.categories.create_category',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.admin.categories.store_category' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'blog_admin/categories/add_category',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageCategoriesController@store',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageCategoriesController@store',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => 'blog_admin/categories',
        'where' => 
        array (
        ),
        'as' => 'blogetc.admin.categories.store_category',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.admin.categories.edit_category' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'blog_admin/categories/edit_category/{categoryId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageCategoriesController@edit',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageCategoriesController@edit',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => 'blog_admin/categories',
        'where' => 
        array (
        ),
        'as' => 'blogetc.admin.categories.edit_category',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.admin.categories.update_category' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'blog_admin/categories/edit_category/{categoryId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageCategoriesController@update',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageCategoriesController@update',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => 'blog_admin/categories',
        'where' => 
        array (
        ),
        'as' => 'blogetc.admin.categories.update_category',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'blogetc.admin.categories.destroy_category' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'blog_admin/categories/delete_category/{categoryId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageCategoriesController@destroy',
        'controller' => '\\WebDevEtc\\BlogEtc\\Controllers\\Admin\\ManageCategoriesController@destroy',
        'namespace' => '\\WebDevEtc\\BlogEtc\\Controllers',
        'prefix' => 'blog_admin/categories',
        'where' => 
        array (
        ),
        'as' => 'blogetc.admin.categories.destroy_category',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::HLfvRiAaE3HZj3CJ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Auth\\AuthController@login',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Auth\\AuthController@login',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::HLfvRiAaE3HZj3CJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::gi8L7xXrGgCOgeX3' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Auth\\AuthController@logout',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Auth\\AuthController@logout',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::gi8L7xXrGgCOgeX3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::HY7DROF8MrOZO5IZ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/stats',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\StatsController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\StatsController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::HY7DROF8MrOZO5IZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::I6PvZKMjyv3fVkwa' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/me',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Profile\\DetailsController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Profile\\DetailsController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::I6PvZKMjyv3fVkwa',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::mm4yvFp84BNGHkUI' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'api/me/details',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Profile\\DetailsController@update',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Profile\\DetailsController@update',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::mm4yvFp84BNGHkUI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::A4Bk4MwsjsVyV5VY' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'api/me/details/auth',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Profile\\AuthDetailsController@update',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Profile\\AuthDetailsController@update',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::A4Bk4MwsjsVyV5VY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::9HcgoP8H49xEsLTt' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/me/avatar',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Profile\\AvatarController@update',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Profile\\AvatarController@update',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::9HcgoP8H49xEsLTt',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::EP7wERizl2rr2ff9' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/me/avatar',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Profile\\AvatarController@destroy',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Profile\\AvatarController@destroy',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::EP7wERizl2rr2ff9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::fOsKJpChU95oOFyI' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/me/avatar/external',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Profile\\AvatarController@updateExternal',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Profile\\AvatarController@updateExternal',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::fOsKJpChU95oOFyI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::o3n28hPCD570wogb' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/me/sessions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Profile\\SessionsController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Profile\\SessionsController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::o3n28hPCD570wogb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::LDU813OLJsUBxah8' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/me/return',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Profile\\DetailsController@returns',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Profile\\DetailsController@returns',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::LDU813OLJsUBxah8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::kR9qxws0NM6Op1ID' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/games',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Games\\GamesController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Games\\GamesController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::kR9qxws0NM6Op1ID',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::hMOxKg7xzhI1ADUw' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/games/{game}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Games\\GamesController@go',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Games\\GamesController@go',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::hMOxKg7xzhI1ADUw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::ddLOykYAq9d56mMf' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/game/{game}/server',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Games\\GamesController@server',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Games\\GamesController@server',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::ddLOykYAq9d56mMf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::SgHLGELZmGmHjSOp' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/category',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Categories\\CategoriesController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Categories\\CategoriesController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::SgHLGELZmGmHjSOp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::7LjE2tHpGVYbCSUB' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/jackpots',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Jackpots\\JackpotsController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Jackpots\\JackpotsController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::7LjE2tHpGVYbCSUB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::K2SgFod3Nd24HN3G' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/transactions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Transactions\\TransactionsController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Transactions\\TransactionsController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::K2SgFod3Nd24HN3G',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::fP5IUOpPawL6gtOU' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/stats/pay',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\GameStats\\GameStatsController@pay',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\GameStats\\GameStatsController@pay',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::fP5IUOpPawL6gtOU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::LYjqtLxjTnwWPb46' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/stats/game',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\GameStats\\GameStatsController@game',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\GameStats\\GameStatsController@game',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::LYjqtLxjTnwWPb46',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::OYeNlBDBA2HOALmA' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/stats/bank',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\GameStats\\GameStatsController@bank',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\GameStats\\GameStatsController@bank',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::OYeNlBDBA2HOALmA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::ZLIrNupdQjZqmv6w' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/stats/shop',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\GameStats\\GameStatsController@shop',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\GameStats\\GameStatsController@shop',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::ZLIrNupdQjZqmv6w',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::y7yXhoMi4EsKRNd1' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/stats/shift',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\GameStats\\GameStatsController@shift',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\GameStats\\GameStatsController@shift',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::y7yXhoMi4EsKRNd1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::PmrjemFekmNoH1jQ' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/shifts/start',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\OpenShiftController@start_shift',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\OpenShiftController@start_shift',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::PmrjemFekmNoH1jQ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::dbyQjgn45telzcRO' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/shifts/info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\OpenShiftController@info',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\OpenShiftController@info',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::dbyQjgn45telzcRO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::X8qnHYPgWTHU0MMX' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/shops/currency',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\ShopController@currency',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\ShopController@currency',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::X8qnHYPgWTHU0MMX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::qygRF0oOZvIvI2rb' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/shops/balance/{type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\ShopController@balance',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\ShopController@balance',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::qygRF0oOZvIvI2rb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::VHlrx3X5zpfHsb6z' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/shops/block',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\ShopController@shop_block',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\ShopController@shop_block',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::VHlrx3X5zpfHsb6z',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::obuFZu67VvaVksGH' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/shops/unblock',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\ShopController@shop_unblock',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\ShopController@shop_unblock',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::obuFZu67VvaVksGH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::2z99gyeGRaFycyEo' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/shops/get',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\ShopController@shop',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\ShopController@shop',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::2z99gyeGRaFycyEo',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'users.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'as' => 'users.index',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Users\\UsersController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Users\\UsersController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'users.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'as' => 'users.store',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Users\\UsersController@store',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Users\\UsersController@store',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'users.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/users/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'as' => 'users.show',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Users\\UsersController@show',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Users\\UsersController@show',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'users.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/users/{user}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'as' => 'users.edit',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Users\\UsersController@edit',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Users\\UsersController@edit',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'users.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'api/users/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'as' => 'users.update',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Users\\UsersController@update',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Users\\UsersController@update',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'users.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/users/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'as' => 'users.destroy',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Users\\UsersController@destroy',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Users\\UsersController@destroy',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::YXFMCIHjzzedTuYL' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/users/{user}/avatar',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Users\\AvatarController@update',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Users\\AvatarController@update',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::YXFMCIHjzzedTuYL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::k1R7RpKOG9Y4IweV' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/users/{user}/avatar/external',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Users\\AvatarController@updateExternal',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Users\\AvatarController@updateExternal',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::k1R7RpKOG9Y4IweV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::wDw2fIlF1G9Nnhgg' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/users/{user}/avatar',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Users\\AvatarController@destroy',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Users\\AvatarController@destroy',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::wDw2fIlF1G9Nnhgg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::4k6JzEuVq4NIuroU' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/users/{user}/activity',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Users\\ActivityController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Users\\ActivityController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::4k6JzEuVq4NIuroU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::Z910J2uHTOMUr9Li' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/users/{user}/sessions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Users\\SessionsController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Users\\SessionsController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::Z910J2uHTOMUr9Li',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::ELrl97XE5RXuHhhr' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/users/{user}/balance/{type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Users\\BalanceController@balance',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Users\\BalanceController@balance',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::ELrl97XE5RXuHhhr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::eMnTt9nRrAamS5zj' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/sessions/{session}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\SessionsController@show',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\SessionsController@show',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::eMnTt9nRrAamS5zj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::4unjtqH3S8Y7gQxb' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/sessions/{session}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\SessionsController@destroy',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\SessionsController@destroy',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::4unjtqH3S8Y7gQxb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::AaOqvaMYNGtgFOZc' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/activity',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\ActivityController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\ActivityController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::AaOqvaMYNGtgFOZc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::TOXeSQFsxBWBUZnh' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/settings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\SettingsController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\SettingsController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::TOXeSQFsxBWBUZnh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::Z0MnYOLbtA1s2Vm7' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/apigame_balance',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'ipcheck',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Api\\Games\\GamesController@apigame_balance',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Api\\Games\\GamesController@apigame_balance',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Api',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::Z0MnYOLbtA1s2Vm7',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::OvpuHSqM5M2p8bEG' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{url}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@SEO',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@SEO',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::OvpuHSqM5M2p8bEG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'url' => '(home|alberta|british-columbia|manitoba|new-brunswick|northwest-territories|nova-scotia|ontario|prince-edward-island|saskatchewan|quebec|vegascasinoonline|casinoniagarafalls|betway|888casino)',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.auth.login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.auth.login',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@getLogin',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@getLogin',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.auth.login.post' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.auth.login.post',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@postLogin',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@postLogin',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.auth.logout' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.auth.logout',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@getLogout',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@getLogout',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.auth.ip' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'ip',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.auth.ip',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@getIP',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@getIP',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.auth.usernameCheck' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'usernameCheck',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.auth.usernameCheck',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@usernameCheck',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@usernameCheck',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.auth.emailCheck' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'emailCheck',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.auth.emailCheck',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@emailCheck',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@emailCheck',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::Pjup8fOZ3sp8X5dZ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'launcher/{game}/{token}/{mode}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@apiLogin',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@apiLogin',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::Pjup8fOZ3sp8X5dZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.register' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.register',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@getRegister',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@getRegister',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.register.post' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.register.post',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@postRegister',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@postRegister',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.register2.post' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'register2',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.register2.post',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@postRegister2',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@postRegister2',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.register.postpage' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'register/page',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.register.postpage',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@postRegisterPage',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@postRegisterPage',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.check_freespin100' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'check_freespin100',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.check_freespin100',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PagesController@check_freespin100',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PagesController@check_freespin100',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.register.confirm-email' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'register/confirmation/{token}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.register.confirm-email',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@confirmEmail',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@confirmEmail',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.forgotpassword' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'forgotpassword',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.forgotpassword',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@forgotPassword',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@forgotPassword',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.password.reset' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/reset/{token}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.password.reset',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@getPasswordReset',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@getPasswordReset',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.password.reset.post' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.password.reset.post',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@postPasswordReset',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@postPasswordReset',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.support.ticket' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'support/ticket',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.support.ticket',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\SupportController@ticket',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\SupportController@ticket',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.deposit.payment' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'deposit/payment',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.deposit.payment',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PaymentController@gigadat',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PaymentController@gigadat',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => '/deposit',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.cashout.payment' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'cashout/payment',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.cashout.payment',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PaymentController@gigadat',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PaymentController@gigadat',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => '/cashout',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.withdraw.payment' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'withdraw/payment',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.withdraw.payment',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PaymentController@withdraw',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PaymentController@withdraw',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => '/withdraw',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::3vr4XlbmvQfShyo9' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'payment/gigadat/success',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PaymentController@gigadatSuccess',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PaymentController@gigadatSuccess',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => '/payment',
        'where' => 
        array (
        ),
        'as' => 'generated::3vr4XlbmvQfShyo9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::S8XJ7ncg9WYNRwd0' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'payment/gigadat/failure',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PaymentController@gigadatFail',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PaymentController@gigadatFail',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => '/payment',
        'where' => 
        array (
        ),
        'as' => 'generated::S8XJ7ncg9WYNRwd0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::zvv8D5wr0DXrpG65' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'payment/gigadat/listener',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PaymentController@gigadatListener',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PaymentController@gigadatListener',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => '/payment',
        'where' => 
        array (
        ),
        'as' => 'generated::zvv8D5wr0DXrpG65',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::0kNjDPRLZUBKdp5i' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'about',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\SupportController@about',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\SupportController@about',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::0kNjDPRLZUBKdp5i',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::iGTQvj44TnZEihRl' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'bonus',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\BonusController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\BonusController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::iGTQvj44TnZEihRl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::InwbIyninrFauZru' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'bonus/term',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\BonusController@term',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\BonusController@term',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::InwbIyninrFauZru',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::BHJoCn1aAfJuFaPL' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'promotions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PromotionsController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PromotionsController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::BHJoCn1aAfJuFaPL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.cryptopayment.cryptocurrencies_list' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'cryptocurrencies_list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.cryptopayment.cryptocurrencies_list',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PaymentController@cryptocurrencies_list',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PaymentController@cryptocurrencies_list',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.check_freemodal' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'check_freemodal',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.check_freemodal',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@check_freemodal',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@check_freemodal',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.check_email' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'check_email',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.check_email',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@check_email',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@check_email',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.games.callback_cryptopayment' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'callback_cryptopayment',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.games.callback_cryptopayment',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PaymentController@callback_cryptopayment',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PaymentController@callback_cryptopayment',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.subsession' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'subsession',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.subsession',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@subsession',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@subsession',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.info' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile/info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.info',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.history.payment' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile/history/payment',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.history.payment',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@payment_history',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@payment_history',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.history.bet' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile/history/bet',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.history.bet',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@bet_history',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@bet_history',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.bonus' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile/bonus',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.bonus',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@bonus',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@bonus',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.freespin' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile/freespin',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.freespin',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@freespin',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@freespin',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.activity' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile/activity',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.activity',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@activity',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@activity',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.balance' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile/balance',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.balance',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@balance',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@balance',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.balance.post' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'profile/balance',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.balance.post',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@balanceAdd',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@balanceAdd',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.balance.success' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile/balance/success',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.balance.success',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@success',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@success',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.balance.fail' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile/balance/fail',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.balance.fail',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@fail',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@fail',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.update.details' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'profile/details/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.update.details',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@updateDetails',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@updateDetails',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.update.password' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'profile/password/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.update.password',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@updatePassword',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@updatePassword',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.update.avatar' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'profile/avatar/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.update.avatar',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@updateAvatar',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@updateAvatar',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.update.avatar-external' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'profile/avatar/update/external',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.update.avatar-external',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@updateAvatarExternal',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@updateAvatarExternal',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.exchange' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'profile/exchange',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.exchange',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@exchange',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@exchange',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.update.login-details' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'profile/login-details/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.update.login-details',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@updateLoginDetails',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@updateLoginDetails',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.two-factor.enable' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'profile/two-factor/enable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.two-factor.enable',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@enableTwoFactorAuth',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@enableTwoFactorAuth',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.two-factor.disable' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'profile/two-factor/disable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.two-factor.disable',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@disableTwoFactorAuth',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@disableTwoFactorAuth',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.sessions' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile/sessions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.sessions',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@sessions',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@sessions',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.sessions.invalidate' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'profile/sessions/{session}/invalidate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.sessions.invalidate',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@invalidateSession',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@invalidateSession',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.returns' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile/returns',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.returns',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@returns',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@returns',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.jackpots' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile/jackpots',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.jackpots',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@jackpots',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@jackpots',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.pincode' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile/pincode',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.pincode',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@pincode',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@pincode',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.verify' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile/verify',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.verify',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@verify',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@verify',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'profile/verify/submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.submit',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@submitImage',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@submitImage',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.password' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile/password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.password',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@password',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@password',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.detail' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile/detail',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.detail',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@detail',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@detail',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.transaction' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile/transaction',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.transaction',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@transaction',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@transaction',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.setlang' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'setlang/{lang}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.setlang',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@setlang',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@setlang',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.deposit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile/deposit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.deposit',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@deposit',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@deposit',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.profile.withdraw' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile/withdraw',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.profile.withdraw',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@withdraw',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\ProfileController@withdraw',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.game.list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.game.list',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.game.search' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'search',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.game.search',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@search',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@search',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.game.list.category' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'categories/{category1}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.game.list.category',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.game.list.category_level2' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'categories/{category1}/{category2}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.game.list.category_level2',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.category.setpage' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'setpage.json',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.category.setpage',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@setpage',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@setpage',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.game.go.prego' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'game/{game}/{prego}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.game.go.prego',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@go',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@go',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.game.init' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'game_init',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.game.init',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@init',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@init',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.game.server' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'game/{game}/server',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.game.server',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@server',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@server',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.game_stat' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'game_stat',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.game_stat',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@game_stat',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@game_stat',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.search.game' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'search',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.search.game',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@searchgame',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@searchgame',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.loadmore.game' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'ajax/loadmore/game',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.loadmore.game',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@loadmore',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@loadmore',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => '/ajax',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.game.apigame' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'apigame/{game}/{type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.game.apigame',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@apigame',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@apigame',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.games.callback_gamehub' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'callback_gamehub',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.games.callback_gamehub',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@callback_gamehub',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\GamesController@callback_gamehub',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.promotions.up_to_100_free_spin' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'canada777-up-to-100-free-spin',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.promotions.up_to_100_free_spin',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PromotionsController@up_to_100_free_spin',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PromotionsController@up_to_100_free_spin',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'phone_verify' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'phone_verify',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@phone_verify',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@phone_verify',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'phone_verify',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.phone_verify2.post' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'phone_verify2',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.phone_verify2.post',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@phone_verify2',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@phone_verify2',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.promotions.up_to_100_free_spin_phone_confirm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'canada777-up-to-100-free-spin-phone-confirm',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.promotions.up_to_100_free_spin_phone_confirm',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PromotionsController@up_to_100_free_spin_phone_confirm',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PromotionsController@up_to_100_free_spin_phone_confirm',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'phone_confirm' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'phone_confirm',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@phone_confirm',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\Auth\\AuthController@phone_confirm',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'phone_confirm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.promotions.welcome_promotion_up_to_100_free_spin' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'canada777-welcome-up-to-100-free-spin',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.promotions.welcome_promotion_up_to_100_free_spin',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PromotionsController@welcome_up_to_100_free_spin',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PromotionsController@welcome_up_to_100_free_spin',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.promotions.up_to_100_free_spin2' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'canada777-up-to-100-free-spin2',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.promotions.up_to_100_free_spin2',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PromotionsController@up_to_100_free_spin2',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PromotionsController@up_to_100_free_spin2',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.promotions.up_to_100_free_spin_phone_confirm2' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'canada777-up-to-100-free-spin-phone-confirm2',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.promotions.up_to_100_free_spin_phone_confirm2',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PromotionsController@up_to_100_free_spin_phone_confirm2',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PromotionsController@up_to_100_free_spin_phone_confirm2',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'frontend.promotions.welcome_promotion_up_to_100_free_spin2' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'canada777-welcome-up-to-100-free-spin2',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'siteisclosed',
        ),
        'as' => 'frontend.promotions.welcome_promotion_up_to_100_free_spin2',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PromotionsController@welcome_up_to_100_free_spin2',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend\\PromotionsController@welcome_up_to_100_free_spin2',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Frontend',
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.auth.login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'backend.auth.login',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\Auth\\AuthController@getLogin',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\Auth\\AuthController@getLogin',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.auth.login.post' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'backend.auth.login.post',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\Auth\\AuthController@postLogin',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\Auth\\AuthController@postLogin',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.auth.logout' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.auth.logout',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\Auth\\AuthController@getLogout',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\Auth\\AuthController@getLogout',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.search' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/search',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:full.search',
        ),
        'as' => 'backend.search',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\DashboardController@search',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\DashboardController@search',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.dashboard',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\DashboardController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\DashboardController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.game_stat' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/game_stat',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:stats.game',
        ),
        'as' => 'backend.game_stat',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\DashboardController@game_stat',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\DashboardController@game_stat',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.game_stat.clear' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'backend/game_stat/clear',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.game_stat.clear',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\DashboardController@game_stat_clear',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\DashboardController@game_stat_clear',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.bank_stat' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/bank_stat',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:stats.bank',
        ),
        'as' => 'backend.bank_stat',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\DashboardController@bank_stat',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\DashboardController@bank_stat',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.shop_stat' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/shop_stat',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:stats.shop',
        ),
        'as' => 'backend.shop_stat',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\DashboardController@shop_stat',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\DashboardController@shop_stat',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.shift_stat' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/shift_stat',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:stats.shift',
        ),
        'as' => 'backend.shift_stat',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\DashboardController@shift_stat',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\DashboardController@shift_stat',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.live_stat' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/live',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:stats.live',
        ),
        'as' => 'backend.live_stat',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\DashboardController@live_stat',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\DashboardController@live_stat',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.start_shift' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/start_shift',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.start_shift',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\DashboardController@start_shift',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\DashboardController@start_shift',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.country' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/country',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:country.manage',
        ),
        'as' => 'backend.country',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@country',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@country',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.currency' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/currency',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:currency.manage',
        ),
        'as' => 'backend.currency',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@country',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@country',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.withdraw.list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/withdraw',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:withdraw.manage',
        ),
        'as' => 'backend.withdraw.list',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\WithDrawController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\WithDrawController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.withdraw.approve' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'backend/withdraw/approve/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:withdraw.manage',
        ),
        'as' => 'backend.withdraw.approve',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\WithDrawController@approve',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\WithDrawController@approve',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.withdraw.reject' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'backend/withdraw/reject/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:withdraw.manage',
        ),
        'as' => 'backend.withdraw.reject',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\WithDrawController@reject',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\WithDrawController@reject',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.crypto_withdraw.approve' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'backend/crypto_withdraw/approve/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:withdraw.manage',
        ),
        'as' => 'backend.crypto_withdraw.approve',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\WithDrawController@crypto_approve',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\WithDrawController@crypto_approve',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.crypto_withdraw.reject' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'backend/crypto_withdraw/reject/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:withdraw.manage',
        ),
        'as' => 'backend.crypto_withdraw.reject',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\WithDrawController@crypto_reject',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\WithDrawController@crypto_reject',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.profile' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.profile',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ProfileController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ProfileController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.profile.activity' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/profile/activity',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.profile.activity',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ProfileController@activity',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ProfileController@activity',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.profile.update.details' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'backend/profile/details/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.profile.update.details',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ProfileController@updateDetails',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ProfileController@updateDetails',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.profile.update.avatar' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/profile/avatar/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.profile.update.avatar',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ProfileController@updateAvatar',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ProfileController@updateAvatar',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.profile.update.avatar-external' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/profile/avatar/update/external',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.profile.update.avatar-external',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ProfileController@updateAvatarExternal',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ProfileController@updateAvatarExternal',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.profile.update.login-details' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'backend/profile/login-details/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.profile.update.login-details',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ProfileController@updateLoginDetails',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ProfileController@updateLoginDetails',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.profile.two-factor.enable' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/profile/two-factor/enable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.profile.two-factor.enable',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ProfileController@enableTwoFactorAuth',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ProfileController@enableTwoFactorAuth',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.profile.two-factor.disable' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/profile/two-factor/disable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.profile.two-factor.disable',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ProfileController@disableTwoFactorAuth',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ProfileController@disableTwoFactorAuth',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.profile.sessions' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/profile/sessions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.profile.sessions',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ProfileController@sessions',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ProfileController@sessions',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.profile.sessions.invalidate' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'backend/profile/sessions/{session}/invalidate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.profile.sessions.invalidate',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ProfileController@invalidateSession',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ProfileController@invalidateSession',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.profile.setshop' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'backend/profile/setshop',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.profile.setshop',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ProfileController@setshop',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ProfileController@setshop',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.user.list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:users.manage',
        ),
        'as' => 'backend.user.list',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.user.tree' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/tree',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:users.tree',
        ),
        'as' => 'backend.user.tree',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@tree',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@tree',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.statistics' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/statistics',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:stats.pay',
        ),
        'as' => 'backend.statistics',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\DashboardController@statistics',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\DashboardController@statistics',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.user.balance.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/profile/balance/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:users.balance.manage',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@updateBalance',
        'as' => 'backend.user.balance.update',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@updateBalance',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.user.balance.update.manually' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/profile/balance/update/manually',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:users.balance.manage',
        ),
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@updateBalanceManually',
        'as' => 'backend.user.balance.update.manually',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@updateBalanceManually',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.user.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/user/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:users.add',
        ),
        'as' => 'backend.user.create',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@create',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@create',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.user.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/user/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:users.add',
        ),
        'as' => 'backend.user.store',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@store',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@store',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.user.stat' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/user/{user}/stat',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.user.stat',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@statistics',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@statistics',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.user.massadd' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/user/mass',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:users.add',
        ),
        'as' => 'backend.user.massadd',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@massadd',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@massadd',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.user.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/user/{user}/show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.user.show',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@view',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@view',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.user.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/user/{user}/profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.user.edit',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@edit',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@edit',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.user.update.details' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'backend/user/{user}/update/details',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.user.update.details',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@updateDetails',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@updateDetails',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.user.update.verify' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'backend/user/{user}/update/verify',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.user.update.verify',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@updateVerify',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@updateVerify',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.user.update.login-details' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'backend/user/{user}/update/login-details',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.user.update.login-details',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@updateLoginDetails',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@updateLoginDetails',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.user.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'backend/user/{user}/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:users.delete',
        ),
        'as' => 'backend.user.delete',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@delete',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@delete',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.user.hard_delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'backend/user/{user}/hard_delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:users.delete',
        ),
        'as' => 'backend.user.hard_delete',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@hard_delete',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@hard_delete',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.user.update.avatar' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/user/{user}/update/avatar',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.user.update.avatar',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@updateAvatar',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@updateAvatar',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.user.update.avatar.external' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/user/{user}/update/avatar/external',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.user.update.avatar.external',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@updateAvatarExternal',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@updateAvatarExternal',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.user.update.deposit-amount' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/user/{user}/update/deposit-amount',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.user.update.deposit-amount',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@updateDepositAmount',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@updateDepositAmount',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.user.sessions' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/user/{user}/sessions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.user.sessions',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@sessions',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@sessions',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.user.sessions.invalidate' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'backend/user/{user}/sessions/{session}/invalidate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.user.sessions.invalidate',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@invalidateSession',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@invalidateSession',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.user.two-factor.enable' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/user/{user}/two-factor/enable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.user.two-factor.enable',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@enableTwoFactorAuth',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@enableTwoFactorAuth',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.user.two-factor.disable' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/user/{user}/two-factor/disable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.user.two-factor.disable',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@disableTwoFactorAuth',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@disableTwoFactorAuth',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.user.action' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'backend/user/action/{action}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.user.action',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@action',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\UsersController@action',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.notifications.list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/notifications',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:notifications.manage',
        ),
        'as' => 'backend.notifications.list',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\NotificationsController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\NotificationsController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.notifications.add' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'backend/notifications/add',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:notifications.manage',
        ),
        'as' => 'backend.notifications.add',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\NotificationsController@add',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\NotificationsController@add',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.notifications.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'backend/notifications/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:notifications.manage',
        ),
        'as' => 'backend.notifications.edit',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\NotificationsController@edit',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\NotificationsController@edit',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.notifications.delete' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/notifications/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:notifications.manage',
        ),
        'as' => 'backend.notifications.delete',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\NotificationsController@delete',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\NotificationsController@delete',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.automizy.create_list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/automizy/create_list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:automizy.manage',
        ),
        'as' => 'backend.automizy.create_list',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\AutomizyController@create_list',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\AutomizyController@create_list',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.automizy.list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/automizy/list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:automizy.manage',
        ),
        'as' => 'backend.automizy.list',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\AutomizyController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\AutomizyController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.automizy.add_list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'backend/automizy/add_list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:automizy.manage',
        ),
        'as' => 'backend.automizy.add_list',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\AutomizyController@add_list',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\AutomizyController@add_list',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.automizy.edit_list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'backend/automizy/edit_list/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:automizy.manage',
        ),
        'as' => 'backend.automizy.edit_list',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\AutomizyController@edit_list',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\AutomizyController@edit_list',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.automizy.delete_list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/automizy/delete_list/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:automizy.manage',
        ),
        'as' => 'backend.automizy.delete_list',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\AutomizyController@delete_list',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\AutomizyController@delete_list',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.automizy.add_contacts' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/automizy/add_contacts/{id}/{email}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:automizy.manage',
        ),
        'as' => 'backend.automizy.add_contacts',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\AutomizyController@add_contacts',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\AutomizyController@add_contacts',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.game.list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/game',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:games.manage',
        ),
        'as' => 'backend.game.list',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.game.list.json' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/games.json',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.game.list.json',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@index_json',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@index_json',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.game.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/game/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:games.add',
        ),
        'as' => 'backend.game.create',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@create',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@create',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.game.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/game/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:games.add',
        ),
        'as' => 'backend.game.store',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@store',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@store',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.game.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/game/{game}/show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.game.show',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@view',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@view',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.game.go' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/game/{game}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.game.go',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@go',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@go',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.game.server' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/game/{game}/server',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.game.server',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@server',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@server',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.game.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/game/{game}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:games.edit',
        ),
        'as' => 'backend.game.edit',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@edit',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@edit',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.game.apiedit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/game/{apigame}/apiedit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:games.edit',
        ),
        'as' => 'backend.game.apiedit',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@apiedit',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@apiedit',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.game.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/game/{game}/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.game.update',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@update',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@update',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.game.apiupdate' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/game/{apigame}/apiupdate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.game.apiupdate',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@apiupdate',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@apiupdate',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.game.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'backend/game/{game}/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:games.delete',
        ),
        'as' => 'backend.game.delete',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@delete',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@delete',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.game.categories' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/game/categories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.game.categories',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@categories',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@categories',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.game.mass' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/game/update/mass',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:games.edit',
        ),
        'as' => 'backend.game.mass',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@mass',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@mass',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.game.orderupdate' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/game/orderupdate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.game.orderupdate',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@orderupdate',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@orderupdate',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.game.gamebanks_add' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/gamebanks_add',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.game.gamebanks_add',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@gamebanks_add',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@gamebanks_add',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.game.gamebanks_clear' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/gamebanks_clear',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.game.gamebanks_clear',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@gamebanks_clear',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\GamesController@gamebanks_clear',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.bonus.list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/bonus',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:bonus.manage',
        ),
        'as' => 'backend.bonus.list',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\BonusController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\BonusController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.bonus.add' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'backend/bonus/add',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:bonus.manage',
        ),
        'as' => 'backend.bonus.add',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\BonusController@add',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\BonusController@add',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.bonus.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'backend/bonus/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:bonus.manage',
        ),
        'as' => 'backend.bonus.edit',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\BonusController@edit',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\BonusController@edit',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.bonus.delete' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/bonus/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:bonus.manage',
        ),
        'as' => 'backend.bonus.delete',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\BonusController@delete',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\BonusController@delete',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.freespinround.list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/freespinround',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:freespinround.manage',
        ),
        'as' => 'backend.freespinround.list',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\FreespinroundController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\FreespinroundController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.freespinround.add' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'backend/freespinround/add',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:freespinround.manage',
        ),
        'as' => 'backend.freespinround.add',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\FreespinroundController@add',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\FreespinroundController@add',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.freespinround.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'backend/freespinround/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:freespinround.manage',
        ),
        'as' => 'backend.freespinround.edit',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\FreespinroundController@edit',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\FreespinroundController@edit',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.freespinround.delete' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/freespinround/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:freespinround.manage',
        ),
        'as' => 'backend.freespinround.delete',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\FreespinroundController@delete',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\FreespinroundController@delete',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.freeplay.list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/freeplay',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:freespinround.manage',
        ),
        'as' => 'backend.freeplay.list',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\FreeplayController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\FreeplayController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.category.list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/category',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:categories.manage',
        ),
        'as' => 'backend.category.list',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\CategoriesController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\CategoriesController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.category.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/category/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:categories.add',
        ),
        'as' => 'backend.category.create',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\CategoriesController@create',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\CategoriesController@create',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.category.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/category/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:categories.add',
        ),
        'as' => 'backend.category.store',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\CategoriesController@store',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\CategoriesController@store',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.category.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/category/{category}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.category.edit',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\CategoriesController@edit',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\CategoriesController@edit',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.category.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/category/{category}/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.category.update',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\CategoriesController@update',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\CategoriesController@update',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.category.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'backend/category/{category}/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:categories.delete',
        ),
        'as' => 'backend.category.delete',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\CategoriesController@delete',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\CategoriesController@delete',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.shop.list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/shops',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:shops.manage',
        ),
        'as' => 'backend.shop.list',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ShopsController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ShopsController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.shop.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/shops/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:shops.manage',
        ),
        'as' => 'backend.shop.create',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ShopsController@create',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ShopsController@create',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.shop.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/shops/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:shops.manage',
        ),
        'as' => 'backend.shop.store',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ShopsController@store',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ShopsController@store',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.shop.admin_create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/shops/admin/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:shops.manage',
        ),
        'as' => 'backend.shop.admin_create',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ShopsController@admin_create',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ShopsController@admin_create',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.shop.admin_store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/shops/admin/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:shops.manage',
        ),
        'as' => 'backend.shop.admin_store',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ShopsController@admin_store',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ShopsController@admin_store',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.shop.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/shops/{shop}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:shops.manage',
        ),
        'as' => 'backend.shop.edit',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ShopsController@edit',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ShopsController@edit',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.shop.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/shops/{shop}/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:shops.manage',
        ),
        'as' => 'backend.shop.update',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ShopsController@update',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ShopsController@update',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.shop.balance' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/shops/balance',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:shops.manage',
        ),
        'as' => 'backend.shop.balance',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ShopsController@balance',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ShopsController@balance',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.shop.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'backend/shops/{shop}/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:shops.manage',
        ),
        'as' => 'backend.shop.delete',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ShopsController@delete',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ShopsController@delete',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.shop.hard_delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'backend/shops/{shop}/hard_delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:shops.manage',
        ),
        'as' => 'backend.shop.hard_delete',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ShopsController@hard_delete',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ShopsController@hard_delete',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.shop.action' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'backend/shops/{shop}/action/{action}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:shops.manage',
        ),
        'as' => 'backend.shop.action',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ShopsController@action',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ShopsController@action',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.pincode.list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/pincodes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:pincodes.manage',
        ),
        'as' => 'backend.pincode.list',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PincodeController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PincodeController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.pincode.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/pincodes/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:pincodes.add',
        ),
        'as' => 'backend.pincode.create',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PincodeController@create',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PincodeController@create',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.pincode.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/pincodes/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:pincodes.add',
        ),
        'as' => 'backend.pincode.store',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PincodeController@store',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PincodeController@store',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.pincode.massadd' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/pincodes/mass/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:pincodes.add',
        ),
        'as' => 'backend.pincode.massadd',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PincodeController@massadd',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PincodeController@massadd',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.pincode.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/pincodes/{pincode}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.pincode.edit',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PincodeController@edit',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PincodeController@edit',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.pincode.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/pincodes/{pincode}/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.pincode.update',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PincodeController@update',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PincodeController@update',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.pincode.balance' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/pincodes/balance',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.pincode.balance',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PincodeController@balance',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PincodeController@balance',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.pincode.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'backend/pincodes/{pincode}/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:pincodes.delete',
        ),
        'as' => 'backend.pincode.delete',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PincodeController@delete',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PincodeController@delete',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.happyhour.list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/happyhours',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:happyhours.manage',
        ),
        'as' => 'backend.happyhour.list',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\HappyHourController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\HappyHourController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.happyhour.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/happyhours/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:happyhours.add',
        ),
        'as' => 'backend.happyhour.create',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\HappyHourController@create',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\HappyHourController@create',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.happyhour.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/happyhours/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:happyhours.add',
        ),
        'as' => 'backend.happyhour.store',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\HappyHourController@store',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\HappyHourController@store',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.happyhour.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/happyhours/{happyhour}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.happyhour.edit',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\HappyHourController@edit',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\HappyHourController@edit',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.happyhour.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/happyhours/{happyhour}/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.happyhour.update',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\HappyHourController@update',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\HappyHourController@update',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.happyhour.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'backend/happyhours/{happyhour}/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:happyhours.delete',
        ),
        'as' => 'backend.happyhour.delete',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\HappyHourController@delete',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\HappyHourController@delete',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.info.list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:helpers.manage',
        ),
        'as' => 'backend.info.list',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\InfoController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\InfoController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.info.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/info/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:helpers.add',
        ),
        'as' => 'backend.info.create',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\InfoController@create',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\InfoController@create',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.info.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/info/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:helpers.add',
        ),
        'as' => 'backend.info.store',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\InfoController@store',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\InfoController@store',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.info.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/info/{info}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.info.edit',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\InfoController@edit',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\InfoController@edit',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.info.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/info/{info}/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.info.update',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\InfoController@update',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\InfoController@update',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.info.balance' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/info/balance',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.info.balance',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\InfoController@balance',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\InfoController@balance',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.info.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'backend/info/{info}/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:helpers.delete',
        ),
        'as' => 'backend.info.delete',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\InfoController@delete',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\InfoController@delete',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.api.list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/api',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:api.manage',
        ),
        'as' => 'backend.api.list',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ApiController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ApiController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.api.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/api/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:api.add',
        ),
        'as' => 'backend.api.create',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ApiController@create',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ApiController@create',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.api.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/api/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:api.add',
        ),
        'as' => 'backend.api.store',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ApiController@store',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ApiController@store',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.api.generate' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/api/generate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.api.generate',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ApiController@generate',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ApiController@generate',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.api.json' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/api/json',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.api.json',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ApiController@json',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ApiController@json',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.api.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/api/{api}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.api.edit',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ApiController@edit',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ApiController@edit',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.api.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/api/{api}/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.api.update',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ApiController@update',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ApiController@update',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.api.balance' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/api/balance',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.api.balance',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ApiController@balance',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ApiController@balance',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.api.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'backend/api/{api}/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:api.delete',
        ),
        'as' => 'backend.api.delete',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ApiController@delete',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ApiController@delete',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.returns.list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/returns',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:returns.manage',
        ),
        'as' => 'backend.returns.list',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ReturnsController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ReturnsController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.returns.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/returns/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:returns.add',
        ),
        'as' => 'backend.returns.create',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ReturnsController@create',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ReturnsController@create',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.returns.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/returns/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:returns.add',
        ),
        'as' => 'backend.returns.store',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ReturnsController@store',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ReturnsController@store',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.returns.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/returns/{return}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.returns.edit',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ReturnsController@edit',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ReturnsController@edit',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.returns.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/returns/{return}/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.returns.update',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ReturnsController@update',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ReturnsController@update',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.returns.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'backend/returns/{return}/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:returns.delete',
        ),
        'as' => 'backend.returns.delete',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ReturnsController@delete',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ReturnsController@delete',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.jpgame.list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/jpgame',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.jpgame.list',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\JPGController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\JPGController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.jpgame.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/jpgame/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.jpgame.create',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\JPGController@create',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\JPGController@create',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.jpgame.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/jpgame/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.jpgame.store',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\JPGController@store',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\JPGController@store',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.jpgame.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/jpgame/{jackpot}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.jpgame.edit',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\JPGController@edit',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\JPGController@edit',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.jpgame.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/jpgame/{jackpot}/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.jpgame.update',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\JPGController@update',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\JPGController@update',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.jpgame.balance' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/jpgame/balance',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.jpgame.balance',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\JPGController@balance',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\JPGController@balance',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.role.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/role',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:roles.manage',
        ),
        'as' => 'backend.role.index',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\RolesController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\RolesController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.role.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/role/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.role.create',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\RolesController@create',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\RolesController@create',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.role.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/role/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.role.store',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\RolesController@store',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\RolesController@store',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.role.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/role/{role}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.role.edit',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\RolesController@edit',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\RolesController@edit',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.role.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'backend/role/{role}/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.role.update',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\RolesController@update',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\RolesController@update',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.role.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'backend/role/{role}/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.role.delete',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\RolesController@delete',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\RolesController@delete',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.permission.save' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/permission/save',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.permission.save',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PermissionsController@saveRolePermissions',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PermissionsController@saveRolePermissions',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.permission.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/permission',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:permissions.manage',
        ),
        'as' => 'backend.permission.index',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PermissionsController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PermissionsController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.permission.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/permission/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:permissions.add',
        ),
        'as' => 'backend.permission.create',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PermissionsController@create',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PermissionsController@create',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.permission.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/permission/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:permissions.add',
        ),
        'as' => 'backend.permission.store',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PermissionsController@store',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PermissionsController@store',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.permission.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/permission/{permission}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.permission.edit',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PermissionsController@edit',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PermissionsController@edit',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.permission.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'backend/permission/{permission}/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.permission.update',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PermissionsController@update',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PermissionsController@update',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.permission.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'backend/permission/{permission}/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.permission.delete',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PermissionsController@delete',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\PermissionsController@delete',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.settings.general' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/settings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:settings.general',
        ),
        'as' => 'backend.settings.general',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\SettingsController@general',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\SettingsController@general',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.settings.general.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/settings/general',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:settings.general',
        ),
        'as' => 'backend.settings.general.update',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\SettingsController@update',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\SettingsController@update',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.settings.auth' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/settings/auth',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:settings.auth',
        ),
        'as' => 'backend.settings.auth',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\SettingsController@auth',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\SettingsController@auth',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.settings.auth.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/settings/auth',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:settings.auth',
        ),
        'as' => 'backend.settings.auth.update',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\SettingsController@update',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\SettingsController@update',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.settings.generator' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/generator',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:settings.generator',
        ),
        'as' => 'backend.settings.generator',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\SettingsController@generator',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\SettingsController@generator',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.settings.generator.post' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'backend/generator',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:settings.generator',
        ),
        'as' => 'backend.settings.generator.post',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\SettingsController@generator',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\SettingsController@generator',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.settings.shop_block' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'backend/shops/block',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:shops.block',
        ),
        'as' => 'backend.settings.shop_block',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\SettingsController@shop_block',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\SettingsController@shop_block',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.settings.shop_unblock' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'backend/shops/unblock',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:shops.unblock',
        ),
        'as' => 'backend.settings.shop_unblock',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\SettingsController@shop_unblock',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\SettingsController@shop_unblock',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.settings.sync' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'backend/settings/sync',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.settings.sync',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\SettingsController@sync',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\SettingsController@sync',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.activity.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/activity',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'permission:users.activity',
        ),
        'as' => 'backend.activity.index',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ActivityController@index',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ActivityController@index',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.activity.user' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'backend/activity/user/{user}/log',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.activity.user',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ActivityController@userActivity',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ActivityController@userActivity',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'backend.activity.clear' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'backend/activity/clear',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'backend.activity.clear',
        'uses' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ActivityController@clear',
        'controller' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend\\ActivityController@clear',
        'namespace' => 'VanguardLTE\\Http\\Controllers\\Web\\Backend',
        'prefix' => '/backend',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
  ),
)
);
