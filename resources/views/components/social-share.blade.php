@props([
    'url' => get_the_permalink(),
    'title' => get_the_title(),
    'hide_on_page' => get_field('hide_social-share'),
])

@if (!$hide_on_page)
    <div class="social-share">
        <div class="social-share__inner">
            <div class="social-share__label">
                <p>Share:</p>
            </div>
            <div class="social-share__list">
                @if ($share_linkedin)
                    <a class="social-share__link hide-external-icon"
                        href="https://www.linkedin.com/shareArticle?mini=true&url={!! rawurlencode($url) !!}&title={!! urlencode($title) !!}"
                        rel="noopener nofollow">
                        <i class="fab fa-linkedin-in" aria-hidden="true"></i>
                        <span class="sr-only">Share on LinkedIn</span>
                    </a>
                @endif
                @if ($share_facebook)
                    <a class="social-share__link hide-external-icon"
                        href="https://www.facebook.com/sharer/sharer.php?u={!! rawurlencode($url) !!}" target="_blank"
                        rel="noopener nofollow">
                        <i class="fab fa-facebook-f" aria-hidden="true"></i>
                        <span class="sr-only">Share on Facebook</span>
                    </a>
                @endif
                @if ($share_email)
                    <a class="social-share__link hide-external-icon"
                        href="mailto:?subject={!! rawurlencode($title) !!}&body={!! rawurlencode($url) !!}"
                        rel="noopener nofollow">
                        <i class="fa-regular fa-envelope" aria-hidden="true"></i>
                        <span class="sr-only">Share via Email</span>
                    </a>
                @endif
                @if ($share_link)
                    <button class="social-share__link hide-external-icon" type="button"
                        onclick="copyToClipboard('{!! $url !!}'); return false;">
                        <i class="fas fa-link" aria-hidden="true"></i>
                        <span class="sr-only">Copy Link</span>
                    </button>
                @endif
            </div>
        </div>
    </div>
    <script>
        function copyToClipboard(text) {
            var dummy = document.createElement("textarea");
            document.body.appendChild(dummy);
            dummy.value = text;
            dummy.select();
            document.execCommand("copy");
            document.body.removeChild(dummy);
            alert("Link copied to clipboard");
        }
    </script>
@endif
