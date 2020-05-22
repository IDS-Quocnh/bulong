<?php

namespace App;

use Spatie\Tags\Tag as SpatieTag;
use Illuminate\Database\Eloquent\Builder;

class Tag extends SpatieTag
{
    public static function scopePopularTags(Builder $query, $type = null, $limit = null)
    {
        $query = "SELECT tags.* , COUNT(tags.id) AS tagged_count FROM tags tags LEFT JOIN taggables taggables ON tags.id = taggables.tag_id";

        $bindings = [];

        if ($type) {
            $query .= " WHERE tags.type = ?";
            $bindings[] = $type;
        }

        $query .= " GROUP BY tags.id";

        $query .= " ORDER BY tagged_count DESC";

        if ($limit) {
            $query .= " LIMIT ?";
            $bindings[] = $limit;
        }

        return static::fromQuery($query, $bindings);
    }
}
