<div class="lgfb-share-icons" data-post-link="{{ esc_url($post_link) }}"> <span class="lgfb-share-article-text">Share Article on:</span>
  <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ esc_url($post_link) }}" class="lgfb-share-icons__icon lgfb-share-icons__icon--facebook" aria-label="Share on Facebook">
    <i class="fab fa-facebook-f"></i>
  </a>

  <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url={{ esc_url($post_link) }}&title={{ esc_attr(get_the_title($post)) }}&summary={{ esc_attr(wp_trim_words($post_content, 40, '...')) }}&source={{ esc_url(home_url()) }}" class="lgfb-share-icons__icon lgfb-share-icons__icon--linkedin" aria-label="Share on LinkedIn">
    <i class="fab fa-linkedin-in"></i>
  </a>

  <a target="_blank" href="mailto:?subject=Check this out&body=I wanted to share this with you. {{ esc_url($post_link) }}" class="lgfb-share-icons__icon lgfb-share-icons__icon--email" aria-label="Share via Email">
    <i class="fas fa-envelope"></i>
  </a>

  <a href="#" class="lgfb-share-icons__icon lgfb-share-icons__icon--link" aria-label="Copy Link" id="copyLink">
    <i class="fas fa-link"></i>
    <!-- Tooltip -->
    <div id="copyTooltip" class="copy-tooltip" style="display: none;">
      Link copied to clipboard!
    </div>
  </a>

</div>


