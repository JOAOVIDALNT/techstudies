import LikeButton from "./like-button";

export default function HomePage() {
  const books = ["Pragmatic programmer", "Grokking Algorithms", "Clean Code"];
  return (
    <div>
        <HeaderComponent title="Favorite programming books"/>
        <ul>
            {books.map((title, index) => ( 
                <li key={index}> {title} </li>
            ))}
        </ul>
        <LikeButton />
    </div>
  );
}

function HeaderComponent({ title }) {
  return (
      <h1>{title ? title : "Default title"}</h1>
  );
}