$(document).ready(function() {
    var app = $.spapp({ pageNotFound: '404.html' }); // initialize with the page for 404 errors

    // Define routes
    app.route({ view: 'about', load: 'about-us.html' });
    app.route({ view: 'account', load: 'account.html' });
    app.route({ view: 'blog', load: 'blog.html' });
    app.route({ view: 'blog-details', load: 'blog-details.html' });
    app.route({ view: 'bmi-calculator', load: 'bmi-calculator.html' });
    app.route({ view: 'class-details', load: 'class-details.html' });
    app.route({ view: 'class-timetable', load: 'class-timetable.html' });
    app.route({ view: 'contact', load: 'contact.html' });
    app.route({ view: 'gallery', load: 'gallery.html' });
    app.route({ view: 'login', load: 'login.html' });
    app.route({ view: 'main', load: 'main.html' });
    app.route({ view: 'register', load: 'register.html' });
    app.route({ view: 'services', load: 'services.html' });
    app.route({ view: 'team', load: 'team.html' });

    // Run the application
    app.run();
});
