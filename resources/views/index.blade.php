@extends('layouts.main')

@section('content')
   
<!-- =============================================
       ABOUT SECTION
       ============================================= -->
  <section class="section-pad section-bg-white" id="home-about">
    <div class="container">
      <div class="row align-items-center gy-5">
        <div class="col-lg-5 animate-fade-left">
          <div class="home-about__img-wrap">
            <img src="https://images.unsplash.com/photo-1497366811353-6870744d04b2?w=700&q=80" alt="About Outline Architects" />
            <div class="home-about__badge">
              <div class="home-about__badge-num">10+</div>
              <div class="home-about__badge-text">Years Of<br/>Experience</div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 offset-lg-1 animate-fade-right">
          <span class="section-label">About Outline</span>
          <h2 class="section-title section-title--lg mb-3">
            We Design. We Plan.<br/>We Deliver Excellence.
          </h2>
          <hr class="divider-primary" />
          <p class="section-subtitle mb-4">
            Outline Architects | Project Management is a multidisciplinary design firm specialising in office interiors, commercial interiors, workspace planning and end-to-end project management. We blend creativity, functionality and precision to deliver spaces that inspire productivity and growth.
          </p>
          <a href="#" class="btn-outline-custom btn-primary-custom">
            More About Us &nbsp;<i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- =============================================
       SERVICES SECTION
       ============================================= -->
  <section class="section-pad" id="home-services">
    <div class="container">
      <div class="row align-items-end mb-5">
        <div class="col-lg-6">
          <span class="section-label">What We Do</span>
          <h2 class="section-title section-title--lg mb-0">Our Services</h2>
        </div>
        <div class="col-lg-6 text-lg-end mt-3 mt-lg-0">
          <a href="#" class="btn-text-link services-view-all">
            View All Services <span class="arrow">→</span>
          </a>
        </div>
      </div>
      <div class="row g-4">
        <div class="col-lg-5">
          <div class="h-100 rounded-3 overflow-hidden services-featured-wrap">
            <img src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?w=700&q=80" alt="Office Interiors" class="services-featured-img" />
          </div>
        </div>
        <div class="col-lg-7">
          <div class="row g-3 h-100">
            <div class="col-sm-6">
              <div class="service-card h-100">
                <div class="service-card__icon"><i class="bi bi-building"></i></div>
                <div class="home-services__card-link">
                  <div>
                    <div class="service-card__title">Office Interiors</div>
                    <p class="service-card__text">Functional, elegant and employee-centric office spaces.</p>
                  </div>
                  <span class="service-arrow"><i class="bi bi-arrow-right"></i></span>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="service-card h-100">
                <div class="service-card__icon"><i class="bi bi-grid-1x2"></i></div>
                <div class="home-services__card-link">
                  <div>
                    <div class="service-card__title">Commercial Interiors</div>
                    <p class="service-card__text">Designing impactful commercial spaces that elevate brand.</p>
                  </div>
                  <span class="service-arrow"><i class="bi bi-arrow-right"></i></span>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="service-card h-100">
                <div class="service-card__icon"><i class="bi bi-rulers"></i></div>
                <div class="home-services__card-link">
                  <div>
                    <div class="service-card__title">Space Planning</div>
                    <p class="service-card__text">Optimal space utilisation for efficiency and productivity.</p>
                  </div>
                  <span class="service-arrow"><i class="bi bi-arrow-right"></i></span>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="service-card h-100">
                <div class="service-card__icon"><i class="bi bi-hammer"></i></div>
                <div class="home-services__card-link">
                  <div>
                    <div class="service-card__title">Design &amp; Build</div>
                    <p class="service-card__text">End-to-end interior execution from concept to completion.</p>
                  </div>
                  <span class="service-arrow"><i class="bi bi-arrow-right"></i></span>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="service-card">
                <div class="d-flex align-items-start gap-3">
                  <div class="service-card__icon flex-shrink-0"><i class="bi bi-kanban"></i></div>
                  <div class="home-services__card-link flex-grow-1">
                    <div>
                      <div class="service-card__title">Project Management</div>
                      <p class="service-card__text mb-0">Seamless execution, on-time delivery and complete transparency.</p>
                    </div>
                    <span class="service-arrow"><i class="bi bi-arrow-right"></i></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- =============================================
       PORTFOLIO / FEATURED WORK
       ============================================= -->
  <section class="section-pad home-portfolio" id="home-portfolio">
    <div class="container">
      <div class="row align-items-end mb-4">
        <div class="col-lg-7">
          <span class="section-label">Featured Work</span>
          <h2 class="section-title section-title--lg mb-2">Spaces That<br/>Speak Excellence</h2>
          <p class="section-subtitle">Explore our portfolio of office and commercial projects crafted with creativity, detail and precision.</p>
        </div>
        <div class="col-lg-5 text-lg-end mt-3 mt-lg-0">
          <a href="#" class="btn-text-link">Explore Portfolio <span class="arrow">→</span></a>
        </div>
      </div>
      <div class="row g-3">
        <div class="col-md-6 col-lg-4">
          <div class="project-card">
            <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?w=600&q=80" alt="TechCorp Offices Pune" class="home-portfolio__project-img" />
            <div class="project-card__overlay">
              <div class="project-card__title">TechCorp Offices</div>
              <div class="project-card__location">Pune</div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="project-card">
            <img src="https://images.unsplash.com/photo-1556761175-4b46a572b786?w=600&q=80" alt="Innovate Workspace Bangalore" class="home-portfolio__project-img" />
            <div class="project-card__overlay">
              <div class="project-card__title">Innovate Workspace</div>
              <div class="project-card__location">Bangalore</div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="project-card">
            <img src="https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=600&q=80" alt="Corporate Headquarters Mumbai" class="home-portfolio__project-img" />
            <div class="project-card__overlay">
              <div class="project-card__title">Corporate Headquarters</div>
              <div class="project-card__location">Mumbai</div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="project-card">
            <img src="https://images.unsplash.com/photo-1517502884422-41eaead166d4?w=600&q=80" alt="Project Experience Center Delhi" class="home-portfolio__project-img" />
            <div class="project-card__overlay">
              <div class="project-card__title">Project Experience Center</div>
              <div class="project-card__location">Delhi</div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="project-card">
            <img src="https://images.unsplash.com/photo-1497366811353-6870744d04b2?w=600&q=80" alt="Fintech Hub Hyderabad" class="home-portfolio__project-img" />
            <div class="project-card__overlay">
              <div class="project-card__title">Fintech Hub</div>
              <div class="project-card__location">Hyderabad</div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="project-card">
            <img src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?w=600&q=80" alt="Creative Studio Chennai" class="home-portfolio__project-img" />
            <div class="project-card__overlay">
              <div class="project-card__title">Creative Studio</div>
              <div class="project-card__location">Chennai</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- =============================================
       STATS SECTION
       ============================================= -->
  <section class="home-stats" id="home-stats">
    <div class="container home-stats__inner">
      <div class="row text-center">
        <div class="col-6 col-md-3 home-stats__item">
          <div class="home-stats__icon mx-auto"><i class="bi bi-award"></i></div>
          <div class="stat-box__number stat-box__number--light">10+</div>
          <div class="stat-box__label stat-box__label--light">Years Of Experience</div>
        </div>
        <div class="col-6 col-md-3 home-stats__item">
          <div class="home-stats__icon mx-auto"><i class="bi bi-briefcase"></i></div>
          <div class="stat-box__number stat-box__number--light">250+</div>
          <div class="stat-box__label stat-box__label--light">Projects Completed</div>
        </div>
        <div class="col-6 col-md-3 home-stats__item">
          <div class="home-stats__icon mx-auto"><i class="bi bi-emoji-smile"></i></div>
          <div class="stat-box__number stat-box__number--light">150+</div>
          <div class="stat-box__label stat-box__label--light">Happy Clients</div>
        </div>
        <div class="col-6 col-md-3 home-stats__item">
          <div class="home-stats__icon mx-auto"><i class="bi bi-people"></i></div>
          <div class="stat-box__number stat-box__number--light">35+</div>
          <div class="stat-box__label stat-box__label--light">Team Members</div>
        </div>
      </div>
    </div>
  </section>

  <!-- =============================================
       WHY CHOOSE US
       ============================================= -->
  <section class="section-pad section-bg-white" id="home-why">
    <div class="container">
      <div class="row align-items-center gy-5">
        <div class="col-lg-6 order-2 order-lg-1 animate-fade-left">
          <span class="section-label">Why Choose Us</span>
          <h2 class="section-title section-title--lg mb-3">We Create More<br/>Than Just Spaces</h2>
          <hr class="divider-primary" />
          <div class="mt-4">
            <div class="check-item">Creative &amp; Functional Designs</div>
            <div class="check-item">End-to-End Solutions</div>
            <div class="check-item">Timely Delivery</div>
            <div class="check-item">Quality Assurance</div>
            <div class="check-item">Client-Centric Approach</div>
          </div>
          <a href="#" class="btn-text-link mt-4">See Our Advantage <span class="arrow">→</span></a>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 animate-fade-right">
          <div class="home-why__img-wrap">
            <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?w=700&q=80" alt="Why Choose Outline" />
            <div class="home-why__promise">
              <h5>Our Promise</h5>
              <p>To deliver innovative, sustainable and functional spaces that elevate business and inspire people.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- =============================================
       TESTIMONIALS
       ============================================= -->
  <section class="section-pad home-testimonials" id="home-testimonials">
    <div class="container">
      <div class="text-center mb-5">
        <span class="section-label">Clients Love Sharing</span>
        <h2 class="section-title section-title--lg">What Our Clients<br/>Say About Us</h2>
      </div>
      <div class="row g-4">
        <div class="col-md-6 col-lg-4">
          <div class="testimonial-card">
            <div class="testimonial-quote">"</div>
            <p class="testimonial-card__text">Outline Architects transformed our workspace into a modern, collaborative environment. Their attention to detail and professionalism is exceptional.</p>
            <div class="d-flex align-items-center gap-3 mt-auto">
              <div class="testimonial-avatar">
                <img src="https://i.pravatar.cc/44?img=12" alt="Rohit Sharma" width="44" height="44" />
              </div>
              <div>
                <div class="testimonial-card__author">Rohit Sharma</div>
                <div class="testimonial-card__role">CEO, TechCorp Solutions</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="testimonial-card">
            <div class="testimonial-quote">"</div>
            <p class="testimonial-card__text">A highly creative and professional team. They delivered our project on time with outstanding quality and commitment to excellence.</p>
            <div class="d-flex align-items-center gap-3 mt-auto">
              <div class="testimonial-avatar">
                <img src="https://i.pravatar.cc/44?img=21" alt="Anita Verma" width="44" height="44" />
              </div>
              <div>
                <div class="testimonial-card__author">Anita Verma</div>
                <div class="testimonial-card__role">Director, Innovate Pvt. Ltd.</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="testimonial-card">
            <div class="testimonial-quote">"</div>
            <p class="testimonial-card__text">From planning to execution, the experience was seamless. Our new office truly reflects our brand and boosts team morale every day.</p>
            <div class="d-flex align-items-center gap-3 mt-auto">
              <div class="testimonial-avatar">
                <img src="https://i.pravatar.cc/44?img=33" alt="Karan Mehta" width="44" height="44" />
              </div>
              <div>
                <div class="testimonial-card__author">Karan Mehta</div>
                <div class="testimonial-card__role">Founder, Creative Studio</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="testimonial-dots">
        <span class="active"></span><span></span><span></span>
      </div>
    </div>
  </section>

  <!-- =============================================
       CTA SECTION
       ============================================= -->
  <section class="home-cta" id="home-cta">
    <div class="home-cta__bg"></div>
    <div class="home-cta__bg-overlay"></div>
    <div class="container home-cta__content text-center">
      <span class="section-label cta-label">Let's Build Together</span>
      <h2 class="section-title section-title--xl section-title--light mt-2 mb-3">Let's Discuss Your Project</h2>
      <p class="section-subtitle mx-auto mb-4 cta-subtitle">
        Share your ideas with us and let's build spaces that inspire, engage and elevate your business.
      </p>
      <a href="#home-contact" class="btn-outline-custom btn-primary-custom cta-btn">
        Get In Touch &nbsp;<i class="bi bi-arrow-right"></i>
      </a>
    </div>
  </section>

  <!-- =============================================
       CONTACT — form left + info/map right
       ============================================= -->
  <section class="home-contact section-pad" id="home-contact">
    <div class="container">
      <div class="row gy-5">

        <!-- Left: Form -->
        <div class="col-lg-6">
          <span class="section-label contact-heading-label">Get In Touch</span>
          <h2 class="section-title section-title--md section-title--light mb-4">We'd Love To Hear From You</h2>
          <div class="row g-3">
            <div class="col-sm-6">
              <input type="text" class="form-control-custom" placeholder="Your Name" />
            </div>
            <div class="col-sm-6">
              <input type="email" class="form-control-custom" placeholder="Email Address" />
            </div>
            <div class="col-sm-6">
              <input type="tel" class="form-control-custom" placeholder="Phone Number" />
            </div>
            <div class="col-sm-6">
              <input type="text" class="form-control-custom" placeholder="Project Type" />
            </div>
            <div class="col-12">
              <textarea class="form-control-custom" rows="4" placeholder="Your Message"></textarea>
            </div>
            <div class="col-12">
              <button type="button" class="btn-outline-custom btn-primary-custom w-100">
                Send Message &nbsp;<i class="bi bi-send"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Right: Info + Map -->
        <div class="col-lg-5 offset-lg-1">
          <div class="mb-2">
            <div class="contact-info-item">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              <span>7th Floor, Inspire Tower, Baker Road, Pune – 411045<br/>Maharashtra, India</span>
            </div>
            <div class="contact-info-item">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              +91 98765-43210
            </div>
            <div class="contact-info-item">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              info@outlinespace.com
            </div>
            <div class="contact-info-item">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              Mon–Sat: 09:00 AM – 07:00 PM
            </div>
          </div>

          <!-- Map iframe -->
          <div class="home-contact__map">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3782.6584988688!2d73.84537!3d18.51957!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2bf4264d7e31d%3A0x6b9b07c16e35f3e8!2sInspire%20Tower%2C%20Baner%2C%20Pune!5e0!3m2!1sen!2sin!4v1699999999999!5m2!1sen!2sin"
              allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
              title="Outline Architects Location">
            </iframe>
          </div>

          <!-- Address badge below map (matches template style) -->
          <div class="contact-map-badge">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <div>
              <strong>Outline Architects</strong>
              <p>7th Floor, Inspire Tower, Baner Pune – 411045</p>
            </div>
          </div>

          <!-- Social icons -->
          <div class="contact-social">
            <div class="social-links">
              <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
              <a href="#" aria-label="Pinterest"><i class="bi bi-pinterest"></i></a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
