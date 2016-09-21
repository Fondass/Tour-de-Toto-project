<?php

/*
 * version update: 1.
 * 
 * Newly added in this version:
 * 
 * 
 * Changes in this version:
 * 
 * 
 * Bugfixes in this version:
 * 
 * 
 */

//===================================================
/*
 * Above is template only.
 * 
 * Changelog shows the changes made in the aplication.
 * 
 * Newest version changes are on top, 
 * going further back in history as you scrolls down.
 */
//===================================================

/*
 * version update: 1.02
 * 
 * Newly added in this version:
 * 
 * added:   Big HTML update! Most if not all of the pages now features slick
 *          HTML that both implement a fancy overlay while keeping to a minimalistic
 *          practical use.
 * 
 * 
 * Changes in this version:
 * 
 * changed: When entering etape conclusions as admin during competition select on admin.page,
 *          competitions of which all etape's have been concluded will no longer show up
 *          in the dropdown selection.
 * 
 * changed: Model functions of page.register have been moved to class.register.functions.php
 *          to comply more with OOP model.
 * 
 * changed: Login and register forms are now directly accessible through page.home
 * 
 * 
 * Bugfixes in this version:
 * 
 * fixed:   Last version broke the "add another winner" button on the admin etape conclusion screen.
 *          This button now works properly in adding new winner entry's.
 * 
 * fixed:   When creating a new competition, the app will no longer show a PhP error
 *          when saving the new competition. Saving did work before.
 * 
 * 
 * Possible bug's in this version:
 * 
 * bug:     Bug in riderlist page where players select their riders where some
 *          riders do not show their team / country. Cannot reproduce bug.
 * 
 */

/*
 * version update: 1.01 - 02-09-2016
 * 
 * Newly added in this version:
 * 
 * added:   Pdf download functionality in the users page. This will give a summary of the
 *          latest rankings and new total score in pdf format.
 * 
 * added:   Excel download button and accompanied excel download in users page
 * 
 * added:   Added back buttons to the following pages: page.users, page.admin, page.etape, page.newtour, 
 *          page.newriders and page.riderlist
 * 
 * 
 * Changes in this version:
 * 
 * changed: When admin selects etape for etape conclussion, etape's that have already been set
 *          are now grayed out and no longer selectable.
 * 
 * changed: When viewing own scores in the ownscores page, you can now only select the
 *          competition in which you actually participate.
 * 
 * changed: Throughout the script, $_SESSION["username"] has been replaced by $_SESSION["userid"],
 *          This is to improve database communication speeds, as query's involving users now use
 *          id's instead of names.
 * 
 * changed: Riders that have been disqualified in a previous etape are now no longer selectable
 *          by the admin when entering etape conclussions for that competition.
 * 
 * changed: When admin enters etape conclussion, position options now automaticaly spring 
 *          to desired position in the form.
 * 
 * 
 * Bugfixes in this version:
 * 
 * fixed:   When calculating latest etape points, reserve riders are now correctly 
 *          added to the point calculation when riders in previous etapes where removed
 *          from the competition.
 * 
 * fixed:   Pdf rankings and excell rankings are now no longer reachable by guest users.
 * 
 * fixed:   When admin selects etape for etape conclussion, etape's now no longer show disabled
 *          if a later etape has been set when they themselves are not set.
 * 
 * fixed:   In the ownscore screen, etape's that were run while a previous etape was not 
 *          run were showing as that previous etape. It will now show the correct etape 
 *          number and score.
 * 
 * fixed:   In etape conclussion, riders that were disqualified in a following etape, while
 *          previous etape had yet to be concluded, now correctly show as participating instead
 *          of dissabled.
 */