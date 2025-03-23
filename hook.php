<?php
/**
 * Install hook
 *
 * @return boolean
 */
function plugin_descriptionCompleter_install()
{
   return true;
}

/**
 * Uninstall hook
 *
 * @return boolean
 */
function plugin_descriptionCompleter_uninstall()
{
   return true;
}

/**
 * Function to replace object content
 *
 * @return void
 */
function replace_description_content(CommonDBTM $item)
{
   $item->input["content"] = htmlentities(
      preg_replace(
         "/t_(\d+)/i",
         '<a href="/front/ticket.form.php?id=$1" target="_blank" rel="noopener">$0</a>',
         html_entity_decode($item->input["content"])
      ),
      ENT_NOQUOTES,
      'utf-8'
   );

   $item->input["content"] = htmlentities(
      preg_replace(
         "/ticket\s(\d+)/i",
         '<a href="/front/ticket.form.php?id=$1" target="_blank" rel="noopener">$0</a>',
         html_entity_decode($item->input["content"])
      ),
      ENT_NOQUOTES,
      'utf-8'
   );
}