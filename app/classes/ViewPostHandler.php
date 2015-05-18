<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/16/2015
 * Time: 4:34 PM
 */
use Illuminate\Session\Store;
class ViewPostHandler {
    private $session;

    public function __construct(Store $session)
    {
        // Let Laravel inject the session Store instance,
        // and assign it to our $session variable.
        $this->session = $session;
    }
    public function handle(Period $period)
    {
        if( ! $this->isPostViewed($period)) {
            // Increment the view counter by one...
            $period->increment('view_counter');

            // Then increment the value on the model so that we can
            // display it. This is because the increment method
            // doesn't increment the value on the model.
            $period->view_counter += 1;
            $this->storePost($period);
        }
    }
    private function isPostViewed($period)
    {
        $viewed = $this->session->get('viewed_posts', []);

        // Check if the post id exists as a key in the array.
        return array_key_exists($period->id, $viewed);
    }
    private function storePost($period)
    {
        // Push the post id onto the viewed_posts session array.
        // First make a key that we can use to store the timestamp
        // in the session. Laravel allows us to use a nested key
        // so that we can set the post id key on the viewed_posts
        // array.
        $key = 'viewed_posts.' . $period->id;

        // Then set that key on the session and set its value
        // to the current timestamp.
        $this->session->put($key, time());
    }

} 