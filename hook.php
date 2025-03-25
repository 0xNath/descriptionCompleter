<?php

use Glpi\Toolbox\Sanitizer;

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
   $regexPatterns = [
      ["pattern" => "/(\s+|[a-z]>)(t_0*(\d+))/iu", "substitute" => '$1<a href="/front/ticket.form.php?id=$3" target="_blank" rel="noopener">$2</a>'],
      ["pattern" => "/(\s+|[a-z]>)(ticket\s*0*(\d+))/iu", "substitute" => '$1<a href="/front/ticket.form.php?id=$3" target="_blank" rel="noopener">$2</a>'],
      ["pattern" => "/(\s+|[a-z]>)(REQ0*(\d+))/iu", "substitute" => '$1<a href="/front/ticket.form.php?id=$3" target="_blank" rel="noopener">$2</a>'],
      ["pattern" => "/(\s+|[a-z]>)(REC0*(\d+))/iu", "substitute" => '$1<a href="/front/ticket.form.php?id=$3" target="_blank" rel="noopener">$2</a>'],
      ["pattern" => "/(\s+|[a-z]>)(PO0*(\d+))/iu", "substitute" => '$1<a href="/front/ticket.form.php?id=$3" target="_blank" rel="noopener">$2</a>'],
   ];

   $decodedContent = Sanitizer::unsanitize($item->input["content"]);

   foreach ($regexPatterns as ["pattern" => $pattern, "substitute" => $substitute]) {
      $decodedContent = preg_replace(
         $pattern,
         $substitute,
         $decodedContent
      );
   }

   $item->input['content'] = Sanitizer::sanitize($decodedContent);
}