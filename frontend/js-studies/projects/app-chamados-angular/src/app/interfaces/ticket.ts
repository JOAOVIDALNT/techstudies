export interface ITicket {
    id: number;
    name: string;
    problem: string;
    sector: string;
    status: string;
    description: string;
    review: string;
    initialDate: Date;
    finishDate: Date;
}
