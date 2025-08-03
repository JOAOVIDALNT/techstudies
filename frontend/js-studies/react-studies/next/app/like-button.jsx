'use client';
import { useState } from 'react';

export default function LikeButton() {
    const [likes, setLikes] = useState(0);
    const incrementLikes = () => setLikes(likes + 1);
    
    return (
        <button onClick={incrementLikes}>
        Like {likes}
        </button>
    );
}