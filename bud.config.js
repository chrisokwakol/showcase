/**
 * Compiler configuration
 *
 * @see {@link https://roots.io/sage/docs sage documentation}
 * @see {@link https://bud.js.org/learn/config bud.js configuration guide}
 *
 * @type {import('@roots/bud').Config}
 */
export default async (bud) => {

  /**
   * Application assets & entrypoints
   *
   * @see {@link https://bud.js.org/reference/bud.entry}
   * @see {@link https://bud.js.org/reference/bud.assets}
   */

  bud
    .entry('app', ['@scripts/app', '@styles/app'])
    .entry('editor', ['@scripts/editor', '@styles/editor'])
    .entry('admin', ['@scripts/admin', '@styles/admin']);

  bud.assets(['images']);

  /**
   * Set public path
   *
   * @see {@link https://bud.js.org/reference/bud.setPublicPath}
   */
  bud.setPublicPath('/app/themes/sage/public/');

  /**
   * Development server settings
   *
   * @see {@link https://bud.js.org/reference/bud.setUrl}
   * @see {@link https://bud.js.org/reference/bud.setProxyUrl}
   * @see {@link https://bud.js.org/reference/bud.watch}
   */
  bud
    .setUrl('http://localhost:3000')
    // .setProxyUrl('http://lgfb.lndo.site:8000')
    .setProxyUrl('https://lgfb.lndo.site')
    .watch(['resources/views', 'app']);

  // bud.react.refresh.enable();
  bud.when(bud.isProduction, bud.minimize)

  /**
   * Generate WordPress `theme.json`
   *
   * @note This overwrites `theme.json` on every build.
   *
   * @see {@link https://bud.js.org/extensions/sage/theme.json}
   * @see {@link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-json}
   */
  bud.wpjson.setSettings({
    background: {
      backgroundImage: true,
    },
    color: {
      custom: false,
      customDuotone: false,
      customGradient: false,
      defaultDuotone: false,
      defaultGradients: false,
      defaultPalette: false,
      duotone: [],
    },
    custom: {
      spacing: {},
      typography: {
        'font-size': {},
        'line-height': {},
      },
    },
    spacing: {
      padding: true,
      units: ['px', '%', 'em', 'rem', 'vw', 'vh'],
    },
    typography: {
      customFontSize: false,
    },
  });
};
