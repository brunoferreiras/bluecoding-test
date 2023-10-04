import { useEffect, useState } from 'react'
import { Head } from '@inertiajs/react'

import Layout from '../Layouts/MainLayout'
import { ListGifs } from './components/ListGifs'

export default function Index({ initialSearch, initialData }) {
    const [search, setSearch] = useState('')
    const [isLoading, setIsLoading] = useState(false)
    const [gifs, setGifs] = useState([])

    const searchGifs = async (offset = 0) => {
        if (search.trim().length === 0) return;
        setIsLoading(true)
        const { data } = await axios.get(`/gifs/search?name=${search}&offset=${offset}`)
        setGifs(previosGifs => offset === 0 ? data : [...previosGifs, ...data])
        setIsLoading(false)
    }

    useEffect(() => {
        if (initialSearch && initialData) {
            setSearch(initialSearch)
            setGifs(initialData)
        }
    }, [initialSearch, initialData])

    return (
        <Layout>
            <Head title="Home" />
            <form onSubmit={(evt) => {
                evt.preventDefault();
                searchGifs()
            }}>
                <div className="flex items-center border-b border-indigo-500 py-2">
                    <input type="submit" hidden />
                    <input
                        className="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                        type="text"
                        value={search}
                        placeholder="Try searching for Cats, Dogs, or Trending GIFs"
                        onChange={(e) => setSearch(e.target.value)}
                    />
                    <button
                        className="flex-shrink-0 bg-indigo-500 hover:bg-indigo-700 border-indigo-500 hover:border-indigo-700 text-sm border-4 text-white py-1 px-2 rounded"
                        type="submit"
                        disabled={isLoading}
                    >
                        {isLoading ? (
                            <div
                                className="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]"
                                role="status">
                            </div>
                        ) : 'Search'}
                    </button>
                </div>
            </form>
            <ListGifs isLoading={isLoading} gifs={gifs} fetchData={searchGifs} />
        </Layout>
    )
}
