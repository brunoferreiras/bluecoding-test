import { useEffect, useState } from "react"

export function ListGifs({ gifs, isLoading, fetchData }) {
    const [offset, setOffset] = useState(0)

    useEffect(() => {
        if (offset === 0) return;
        fetchData(offset);
    }, [offset])

    useEffect(() => {
        if (gifs.length === 25) {
            setOffset(0)
        }
    }, [gifs])

    const handleScroll = () => {
        if (window.innerHeight + document.documentElement.scrollTop !== document.documentElement.offsetHeight || isLoading) {
            return;
        }
        setOffset(previousState => previousState + 25);
    };

    useEffect(() => {
        window.addEventListener('scroll', handleScroll);
        return () => window.removeEventListener('scroll', handleScroll);
    }, [isLoading]);

    const renderGifs = () => {
        return gifs?.map((gif, index) => {
            return (
                <div key={index} className="flex w-1/3 flex-wrap">
                    <div className="w-full p-1 md:p-2">
                        <img
                            alt={gif.title}
                            title={gif.title}
                            className="block h-full w-full rounded-lg object-cover object-center"
                            src={gif?.images?.downsized?.url}
                        />
                    </div>
                </div>
            )
        })
    }
    return (
        <div className="container mx-auto px-5 py-2 lg:px-32 lg:pt-12">
            <div className="-m-1 flex flex-wrap md:-m-2">
                {renderGifs()}
            </div>
            {isLoading && <p>Loading...</p>}
        </div>
    )
}
