<?php
define('descriptionCompleter', '0.0.1');

use Glpi\Plugin\Hooks;

/**
 * Init the hooks of the plugins - Needed
 *
 * @return void
 */
function plugin_init_descriptionCompleter()
{
    global $PLUGIN_HOOKS;

    $PLUGIN_HOOKS[Hooks::CSRF_COMPLIANT]['descriptionCompleter'] = true;
    $PLUGIN_HOOKS[Hooks::PRE_ITEM_ADD]['descriptionCompleter'] = [
        Ticket::class => 'replace_description_content',
        ITILFollowup::class => 'replace_description_content',
        ITILSolution::class => 'replace_description_content',
        ITILValidation::class => 'replace_description_content',
        Problem::class => 'replace_description_content',
        Change::class => 'replace_description_content',
    ];
}

/**
 * Get the name and the version of the plugin - Needed
 *
 * @return array
 */
function plugin_version_descriptionCompleter()
{
    return [
        'name' => 'description completer',
        'version' => '0.0.1',
        'author' => 'Nathanaël Renaud</a>',
        'license' => 'GLPv3',
        'homepage' => 'https://github.com/0xNath/descriptionCompleter',
        'requirements' => [
            'glpi' => [
                'min' => '10.0.0'
            ]
        ]
    ];
}

/**
 * Optional : check prerequisites before install : may print errors or add to message after redirect
 *
 * @return boolean
 */
function plugin_descriptionCompleter_check_prerequisites()
{
    return true;
}

/**
 * Check configuration process for plugin : need to return true if succeeded
 * Can display a message only if failure and $verbose is true
 *
 * @param boolean $verbose Enable verbosity. Default to false
 *
 * @return boolean
 */
function plugin_descriptionCompleter_check_config($verbose = false)
{
    if (true) {
        return true;
    }

    if ($verbose) {
        echo "Installed, but not configured";
    }
    return false;
}

/**
 * Optional: defines plugin options.
 *
 * @return array
 */
function plugin_descriptionCompleter_options()
{
    return [
        Plugin::OPTION_AUTOINSTALL_DISABLED => true,
    ];
}