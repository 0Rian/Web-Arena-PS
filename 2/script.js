$(document).ready(function() {
  $("a[href^='#']").on('click', function(e) {
    e.preventDefault();
    const target = $($(this).attr('href'));
    if (target.length) {
      $('html, body').animate({ scrollTop: target.offset().top - 70 }, 600);
    }
  });

  $(window).on('scroll', function() {
    $('.fade-in-up').each(function() {
      const top = $(this).offset().top;
      const scroll = $(window).scrollTop();
      const windowHeight = $(window).height();
      if (scroll > top - windowHeight + 100) {
        $(this).addClass('visible');
      }
    });
  });
});
