@if (!empty($title))
  <section id="{{ $block->block->anchor ?? $block->block->id }}" class="journey-strip {{ $block->classes }}" id="journey-strip-section">
      <div class="container">
        <div class="journey-strip__inner">
          <div class="journey-strip__top">
            <h3 class="journey-strip__top__title bold">{{ $title }}</h3>  
            <div class="journey-strip__top__stage">
              <label for="stage-dropdown">I am...</label>
              <select name="journey_strip_stage" id="journey_strip_stage">
                @foreach($stage as $stage_id)
                  @php
                    $stage_term = get_term($stage_id, 'treatment-stage');
                  @endphp
                  @if($stage_term && !is_wp_error($stage_term))
                    <option value="{{ $stage_term->term_id }}">
                      {{ $stage_term->name }}
                    </option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="journey-strip__top__topic">
              <label for="topic-dropdown">I need...</label>
              <select name="journey_strip_topic" id="journey_strip_topic">
                @foreach($topics as $topic)
                  @php
                      $label = $topic['label'];
                      $topic_id = $topic['topic'];
                      $term = get_term($topic_id, 'topic');
                  @endphp
                  @if($term && !is_wp_error($term))
                    <option value="{{ $term->term_id }}">
                        {{ $label }}
                    </option>
                  @endif
                @endforeach
              </select>
            </div>
            <button class="btn-lgfb btn-lgfb--phantom btn-lgfb--medium journey-strip__top__cta"
              data-nonce="{{ wp_create_nonce('journey_strip_nonce') }}"
              data-url="{{ admin_url('admin-ajax.php') }}"
              data-cta="{{ $cta }}">
              <span>{{ $cta }}</span>
              <i class="fas fa-circle-notch fa-spin journey-strip__top__cta__spinner" style="display:none;"></i>
            </button>
          </div>
      </div>
  </section>
  <div class="journey-strip__results"></div>
@endif
