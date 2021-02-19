import ApolloClient from 'apollo-client'
import { createHttpLink } from 'apollo-link-http';
import { onError } from "apollo-link-error";
import { InMemoryCache } from 'apollo-cache-inmemory';
import gql from 'graphql-tag'
import ListingsGQL from '../gql/listings.gql';
import CategoriesGQL from '../gql/categories.gql';

class DestinationsClient {

    static get LISTINGS_GRAPHQL() {
        return ListingsGQL;
    }

    static get GATEGORIES_GRAPHQL() {
        return CategoriesGQL;
    }

    constructor(endpoint, gql = null, variables = {}) {
        this.endpoint = endpoint;
        this.gql = gql;
        this.variables = variables;
    }

    setQuery(gql) {
        this.gql = gql;
        return this;
    }

    setVars(vars) {
        this.variables = vars;
        return this;
    }

    async getResults() {
        const result = await client(this.endpoint).query({
            query: this.gql,
            variables: this.variables,
        })
        if (result) {
            return result.data;
        }
    }

}

export const client = (endpoint) => {
    const httpLink = createHttpLink({ uri: endpoint });

    const errorLink = onError(({ graphQLErrors, networkError }) => {
        if (graphQLErrors)
            graphQLErrors.forEach(({ message, locations, path }) =>
                console.log(
                    `[GraphQL error]: Message: ${message}, Location: ${locations}, Path: ${path}`
                )
            );
        if (networkError) console.log(`[Network error]: ${networkError}`);
    });

    const link = errorLink.concat(httpLink);

    return new ApolloClient({
        cache: new InMemoryCache(),
        link,
        connectToDevTools: true,
    })
}

export default DestinationsClient;
